<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Crear Producto') }}
        </h2>
    </x-slot>

    <div>
        <form action="{{ route('products.store')}}" method="POST">
            @csrf
            <x-input-group
                name="name"
                label="Nombre"
                required="true"
            />

            <x-select-field 
                name="brand_id"
                label="Marca"
                :options="$brands->pluck('name', 'id')"
            />
            
            <x-input-group
                name="cost"
                label="Costo"
                required="true"
            />
            <x-input-group
                name="retencion"
                label="Retención"
                required="false"
            />
            <x-input-group
                name="flete"
                label="Flete"
                required="false"
            />
            <x-input-group
                name="IVA"
                label="IVA"
                required="false"
            />
            <x-input-group
                name="cost_with_taxes"
                label="Costo con Impuestos"
                required="false"
            />
            <x-input-group
                name="utility"
                label="Utilidad"
                required="true"
            />
            <x-input-group
                name="price"
                label="Precio"
                required="true"
            />
            <x-input-group
                name="discount"
                label="Descuento"
                required="false"
            />
            <x-input-group
                name="expiration_date"
                type="date"
                label="Fecha de Expiración"
                required="false"
            />
            <x-input-group
                name="price_with_discount"
                label="Precio Final"
                required="false"
            />
            <x-input-group
                name="rentability"
                label="Rentabilidad"
                required="true"
            />
            <x-input-group
                name="details"
                label="Detalles"
                required="false"
            />
            <x-select-field 
                name="unity_type"
                label="Tipo de Unidad"
                :options="[
                    'unit' => 'Unidad',
                    'volume' => 'Volumen',
                    'weight' => 'Peso'
                ]"
            />
            <x-select-field 
                name="unit_of_measure"
                label="Unidad de Medida"
                :options="[
                    'CC' => 'CC',
                    'GR' => 'GR',
                    'ML' => 'ML',
                    'KG' => 'KG',
                    'LT' => 'LT',
                    'G'  => 'G',
                    'UNIDAD' => 'UNIDAD',
                ]"
            />
            <x-input-group
                name="quantity"
                label="Cantidad"
                required="true"
            />
            <x-primary-button type="submit" />
        </form>
    </div>
</x-app-layout>