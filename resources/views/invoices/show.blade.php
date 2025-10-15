<x-app-layout>
    <x-slot name="header">
        {{ __('Factura de Venta') }}
    </x-slot>

    <div class="flex justify-center print:m-0 print:p-0">
        <div class="w-[80mm] bg-white text-[11px] leading-tight p-2 font-mono">
            <!-- Encabezado -->
            <div class="text-center border-b border-dashed pb-2 mb-2">
                <img src="{{ asset('images/logo_empresa.png') }}" alt="Logo Empresa" class="mx-auto w-12 mb-1">
                <h1 class="text-sm font-bold uppercase">La Guaca</h1>
                <p class="text-xs">COMERCIALIZADORA DE LA ESPRIELLA SAS</p>
                <p>NIT: 901656873-7</p>
                <p>Dirección: BRR COROCITO CL 17 B CR</p>
                <p>Ciudad: SAHAGÚN - CÓRDOBA</p>
                <p>Tel: 3003087223</p>
                {{-- <p>Condición IVA: IVA</p> --}}
            </div>

            <!-- Datos de factura -->
            <div class="border-b border-dashed pb-2 mb-2">
                <p><span class="font-semibold">Factura:</span> FAC{{ str_pad($data->id, 6, '0', STR_PAD_LEFT) }}</p>
                <p><span class="font-semibold">Cliente:</span> {{ $data->client->customer_name }}</p>
                <p><span class="font-semibold">CC:</span> {{ $data->client->identification }}</p>
                <p><span class="font-semibold">Fecha:</span> {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y h:i a') }}</p>
            </div>

            <!-- Productos -->
            <div class="mb-2">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-dashed">
                            <th class="w-8">Cant</th>
                            <th>Descripción</th>
                            <th class="text-right">V. Unit</th>
                            <th class="text-right">%Dto</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->sales as $item)
                            <tr class="align-top">
                                <td>{{ (int) $item->quantity }}</td>
                                <td class="pr-1">{{ $item->product->name }}</td>
                                <td class="text-right">{{ number_format($item->product->price, 0) }}</td>
                                <td class="text-right">{{ (int) $item->product->discount }}</td>
                                <td class="text-right">{{ number_format($item->sale_amount, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Totales -->
            <div class="border-t border-dashed pt-2 mb-2 text-xs">
                <div class="flex justify-between">
                    <span>Descuento total:</span>
                    <span>{{ number_format($data->total_discount, 0) }}</span>
                </div>
                <div class="flex justify-between font-semibold border-t border-dashed mt-1 pt-1">
                    <span>Total:</span>
                    <span>{{ number_format($data->total_sale, 0) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Recibido:</span>
                    <span>{{ number_format($data->received_amount, 0) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Cambio:</span>
                    <span>{{ number_format($data->change_amount, 0) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Método:</span>
                    <span>{{ ucfirst($data->payment_method) }}</span>
                </div>
            </div>

            <!-- Pie -->
            <div class="text-center mt-2 text-[10px]">
                <p>Conserve esta factura para cualquier reclamo o garantía.</p>
                <p>¡Gracias por su compra! 😊</p>
                <p class="mt-2 text-[8px] text-gray-500">By Diego Andrés Salcedo Romero | Software Development</p>
            </div>
        </div>
    </div>

    <!-- Botones solo visibles en pantalla -->
    <div class="flex justify-center gap-4 mt-4 print:hidden">
        <button onclick="window.print()" class="px-3 py-1 bg-blue-600 text-white rounded">Imprimir</button>
        <button onclick="history.back()" class="px-3 py-1 bg-gray-500 text-white rounded">Regresar</button>
    </div>
</x-app-layout>
