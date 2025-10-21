@push('scripts') 
    @vite([ 
        'resources/js/productForm.js' 
    ]) 
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Crear Producto') }}
        </h2>
    </x-slot>

    <div>
        <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- 🧩 Sección principal del formulario en grilla -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <x-input-group name="name" label="Nombre" required="true" />

                <x-select-field 
                    name="brand_id"
                    label="Marca"
                    :options="$brands->pluck('name', 'id')"
                />

                <x-input-group name="cost" label="Costo" required="true" />

                <x-input-group name="retencion" label="Retención" />
                <x-input-group name="flete" label="Flete" />
                <x-input-group name="IVA" label="IVA" />
                <x-input-group name="cost_with_taxes" label="Costo con Impuestos" />
                <x-input-group name="utility" label="Utilidad" required="true" />
                <x-input-group name="price" label="Precio" required="true" />
                <x-input-group name="discount" label="Descuento" />
                <x-input-group name="expiration_date" type="date" label="Fecha de Expiración" />
                <x-input-group name="price_with_discount" label="Precio Final" />
                <x-input-group name="rentability" label="Rentabilidad" required="true" />
                <x-input-group name="details" label="Detalles" />
                
                {{-- <x-select-field 
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
                /> --}}

                <x-input-group name="quantity" label="Cantidad" required="true" />
            </div>

            <!-- 🧭 Botón centrado -->
            <div class="flex justify-center pt-4">
                <x-primary-button type="submit">
                    💾 Guardar Producto
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
