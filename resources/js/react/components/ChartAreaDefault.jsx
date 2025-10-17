"use client";

import React, { useEffect, useState } from "react";
import { TrendingUp } from "lucide-react";
import { Area, AreaChart, CartesianGrid, XAxis } from "recharts";

import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";

import {
  ChartContainer,
  ChartTooltip,
  ChartTooltipContent,
} from "@/components/ui/chart";

// 💰 Función para formatear precios en pesos colombianos
const formatPrice = (value) => {
  return new Intl.NumberFormat("es-CO", {
    style: "currency",
    currency: "COP",
    minimumFractionDigits: 0,
  }).format(Number(value));
};

export default function ChartAreaDefault() {
  const [chartData, setChartData] = useState([]);

  // 🧠 Carga de datos desde Laravel
  useEffect(() => {
    fetch("/sales/monthly")
      .then((res) => res.json())
      .then((data) => {
        // Formatear datos para el gráfico
        const formatted = data.map((item) => ({
          month: new Date(2024, item.month - 1).toLocaleString("es-ES", {
            month: "short",
          }),
          total: Number(item.total_sales), // aseguramos que sea número
          totalFormatted: formatPrice(item.total_sales), // precio formateado para tooltip
        }));
        setChartData(formatted);
      })
      .catch((err) => console.error("Error al cargar ventas:", err));
  }, []);

  const chartConfig = {
    total: {
      label: "Ventas",
      color: "var(--chart-1)",
    },
  };

  return (
    <Card>
      <CardHeader>
        <CardTitle>Ventas Mensuales</CardTitle>
        <CardDescription>Total de ventas de los últimos meses</CardDescription>
      </CardHeader>

      <CardContent>
        <ChartContainer config={chartConfig}>
          <AreaChart
            data={chartData}
            margin={{
              left: 12,
              right: 12,
            }}
          >
            <CartesianGrid vertical={false} />
            <XAxis
              dataKey="month"
              tickLine={false}
              axisLine={false}
              tickMargin={8}
            />
            <ChartTooltip
              cursor={false}
              content={
                <ChartTooltipContent
                  indicator="line"
                  labelFormatter={(month) => `Mes: ${month}`}
                  formatter={(_, __, item) =>
                    [`${item.payload.totalFormatted}`, " Ventas"]
                  }
                />
              }
            />
            <Area
              dataKey="total"
              type="natural"
              fill="var(--color-total)"
              fillOpacity={0.4}
              stroke="var(--color-total)"
            />
          </AreaChart>
        </ChartContainer>
      </CardContent>

      <CardFooter>
        <div className="flex w-full items-start gap-2 text-sm">
          <div className="grid gap-2">
            <div className="flex items-center gap-2 leading-none font-medium">
              Incremento mensual estimado <TrendingUp className="h-4 w-4" />
            </div>
          </div>
        </div>
      </CardFooter>
    </Card>
  );
}
