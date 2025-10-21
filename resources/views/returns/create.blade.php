@push('scripts')
    @vite([
        'resources/js/getDataInvoice.js'
    ])
@endpush


<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Crear Devolución') }}
        </h2>
    </x-slot>

    <div>
            @csrf
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <x-input-group
                    name="invoice_id"
                    label="Código de factura"
                    required="true"
                />
            </div>

            <table id="invoice-data" class="table-auto w-full border mt-4">
                <thead>
                    <tr class="bg-gray-100">
                        <th>Total Venta</th>
                        <th>Total Descuento</th>
                        <th>Valor Recibido</th>
                        <th>Valor Devuelto</th>
                        <th>Metodo de Pago</th>
                        <th>Cliente</th>
                    </tr>
                </thead>
                <tbody id="invoice-table-body">
                    <tr><td colspan="5" class="text-center text-gray-500">Sin datos</td></tr>
                </tbody>
            </table>

            <table class="table-auto w-full border mt-4">
                <thead>
                    <tr class="bg-gray-100">
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Descuento</th>
                        <th>Precio Final</th>
                        <th>Total</th>
                        <th>Unidades Devolución</th>
                        <th>Reinsertar Inventario</th>
                    </tr>
                </thead>
                <tbody id="sales-table-body">
                    <tr><td colspan="5" class="text-center text-gray-500">Sin datos</td></tr>
                </tbody>
            </table>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <x-input-group
                    name="reason"
                    label="Razón"
                />
            </div>
            <div class="flex justify-center pt-4">
                <x-primary-button type="submit">Guardar Devolución</x-primary-button>
            </div>
    </div>
</x-app-layout>