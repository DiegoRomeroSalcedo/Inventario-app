@push('scripts')
    @vite([
        'resources/js/salesPage.js',
        'resources/js/getDataClient.js',
    ])
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Insertar Venta')}}
        </h2>
    </x-slot>

        <form action="{{ route('sales.store')}}" method="POST">
            @csrf
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-4">
                <x-input-group
                name="id"
                label="Código de producto"
                required="true"
            />
            </div>
        </form>
        <table id="data-product" class="table-auto w-full border mt-4">
    <thead>
        <tr class="bg-gray-100">
            <th>Código</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Descuento</th>
            <th>Precio Final</th>
            <th>Detalle</th>
            <th>Cantidad Inventario</th>
            <th>Cantidad Venta</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody id="product-table-body">
        <tr><td colspan="12" class="text-center text-gray-500">Sin datos</td></tr>
    </tbody>
</table>

        <table id="list" class="table-auto w-full border mt-4 mb-8">
            <thead>
                <tr class="bg-gray-100">
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Cantidad</th>
                    <th>IVA</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr><td colspan="12" class="text-center text-gray-500">Sin datos</td></tr>
            </tbody>
        </table>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
            {{-- Info de vuelto --}}
            <x-input-group
                name="total_sale"
                label="Total de la venta"
                required="false"
                {{-- value="2222222222" --}}
            />
            <x-input-group
                name="received_amount"
                label="Monto recibido"
                required="false"
                {{-- value="2222222222" --}}
            />
            <x-input-group
                name="change"
                label="Valor Cambio"
                required="false"
                {{-- value="2222222222" --}}
            />
            <x-select-field 
                name="payment_method"
                label="Método de pago"
                :options="[
                    'electronic' => 'Pago Electronico',
                    'cash' => 'Efectivo',
                    'card' => 'Tarjeta',
                    'transfer' => 'Transferencia',
                    'check' => 'Cheque',
                    'other' => 'Otro',
                ]"
            />
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-4">
            <x-input-group
            name="identification"
            label="Cédula del cliente"
            required="false"
            value="2222222222"
            />
            <x-input-group
            name="customer_name"
            label="Nombres"
            required="false"
            value="Cliente Genérico"
            />
            <x-input-group
            name="phone"
            label="Teléfono"
            required="false"
            value="0000000000"
            />
            <x-input-group
            name="email"
            label="Correo"
            required="false"
            value="clientegenérico@gmail.com"
            />
            <x-input-group
            name="address"
            label="Dirección"
            required="false"
            value="Ciudad"
            />
            <x-input-group
                type="hidden"
                label=""
                name="customer_id"
                id="customer_id"
            />
        </div>
        <div class="flex justify-center pt-4">
            <x-primary-button id="finalize-sale">
                Guardar venta
            </x-primary-button>
        </div>
</x-app-layout>