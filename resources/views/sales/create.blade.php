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
            <x-input-group
                name="id"
                label="ID"
                required="true"
            />
        </form>
        <div id="data-product">
            <!-- Aquí se mostrarán los datos del producto -->
        </div>
        <table id="list">
            <thead>
                <tr>
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
            <tbody></tbody>
        </table>
        <div>
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
        <div>
            <h2>Información del cliente</h2>
            <x-input-group
                type="hidden"
                label=""
                name="customer_id"
                id="customer_id"
            />
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
            <x-primary-button id="finalize-sale">
                Guardar venta
            </x-primary-button>
        </div>
</x-app-layout>