@push('scripts')
    @vite([
        'resources/js/productForm.js'
    ])
@endpush


<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Actualizar Producto') }}
        </h2>
    </x-slot>

    <div>
        <form action="{{ route('products.update', $data->id)}}" method="POST">
            @csrf
            @method('PUT')
            <x-input-group
                name="name"
                label="Nombre"
                required="true"
                value="{{ old('name', $data->name)}}"
            />

            <x-select-field 
                name="brand_id"
                label="Marca"
                :options="$brands->pluck('name', 'id')"
                :selected="old('brand_id', $data->brand_id)"
            />
            
            <x-input-group
                name="cost"
                label="Costo"
                required="true"
                value="{{ old('cost', $data->cost)}}"
            />
            <x-input-group
                name="retencion"
                label="Retención"
                value="{{ old('retencion', $data->retencion)}}"
            />
            <x-input-group
                name="flete"
                label="Flete"
                value="{{ old('flete', $data->flete)}}"
            />
            <x-input-group
                name="IVA"
                label="IVA"
                value="{{ old('IVA', $data->IVA)}}"
            />
            <x-input-group
                name="cost_with_taxes"
                label="Costo con Impuestos"
                required="false"
                value="{{ old('cost_with_taxes', $data->cost_with_taxes)}}"
            />
            <x-input-group
                name="utility"
                label="Utilidad"
                required="true"
                value="{{ old('utility', $data->utility)}}"
            />
            <x-input-group
                name="price"
                label="Precio"
                required="true"
                value="{{ old('price', $data->price)}}"
            />
            <x-input-group
                name="discount"
                label="Descuento"
                required="false"
                value="{{ old('discount', $data->discount)}}"
            />
            <x-input-group
                name="expiration_date"
                type="date"
                label="Fecha de Expiración"
                required="false"
                value="{{ old('expiration_date', $data->expiration_date)}}"
            />
            <x-input-group
                name="price_with_discount"
                label="Precio Final"
                required="false"
                value="{{ old('price_with_discount', $data->price_with_discount)}}"
            />
            <x-input-group
                name="rentability"
                label="Rentabilidad"
                required="true"
                value="{{ old('rentability', $data->rentability)}}"
            />
            <x-input-group
                name="details"
                label="Detalles"
                required="false"
                value="{{ old('details', $data->details)}}"
            />
            <x-select-field 
                name="unity_type"
                label="Tipo de Unidad"
                :options="[
                    'unit' => 'Unidad',
                    'volume' => 'Volumen',
                    'weight' => 'Peso'
                ]"
                :selected="old('unity_type', $data->unity_type)"
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
                :selected="old('unit_of_measure', $data->unit_of_measure)"
            />
            <x-input-group
                name="quantity"
                label="Cantidad"
                required="true"
                value="{{ old('quantity', $data->stock->quantity)}}"
            />
            <x-primary-button type="submit" />
        </form>
    </div>
</x-app-layout>