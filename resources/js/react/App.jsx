import React from "react";
import ReactDOM from "react-dom/client";
import ChartAreaDefault from "./components/ChartAreaDefault";

function App() {
    return (
        <div className="p-10 max-w-3xl mx-auto">
            <h1 className="text-2xl font-bold mb-6 text-center">Panel de Ventas 📊</h1>
            <ChartAreaDefault />
        </div>
    );
}

ReactDOM.createRoot(document.getElementById("react-root")).render(<App />);
