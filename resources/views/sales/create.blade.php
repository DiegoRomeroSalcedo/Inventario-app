@push('scripts')
    @vite([
        'resources/js/getDataProduct.js',
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
            <h2>Información del cliente</h2>
            <x-input-group
                name="identification"
                label="Cédula del cliente"
                required="false"
                value="2222222222"
            />
            <x-input-group
                name="name"
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
        </div>
</x-app-layout>