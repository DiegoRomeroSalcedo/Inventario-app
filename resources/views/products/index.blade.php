<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Productos') }}
        </h2>
    </x-slot>
    <x-primary-button>
        <a href="{{ route('products.create') }}">Crear Producto</a>
    </x-primary-button>
    <div>
        <div>
            <table id="products-table" class="display">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Inventario</th>
                        <th>Costo</th>
                        <th>Flete</th>
                        <th>Retención</th>
                        <th>IVA</th>
                        <th>Costo Final</th>
                        <th>Utilidad</th>
                        <th>Precio</th>
                        <th>Descuento</th>
                        <th>Precio Final</th>
                        <th>Rentabilidad</th>
                        <th>Detalle</th>
                        <th>Usuario Actualización</th>
                        <th>Fecha de Creación</th>
                        <th>Fecha de Actualización</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Cuerpo del datatable --}}
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.3.2/js/dataTables.tailwindcss.js"></script>

        <script>
            console.log("Cargando datatable...");
            new DataTable("#products-table", {
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.getJsonToProducts')}}",
                columns: [
                    {
                        data: 'id',
                        render: function(data) {
                            return `<a href="{{ url('products')}}/${data}">${data}</a>`
                        },
                        searchable: true,
                        orderable: true
                    },
                    { data: 'name' },
                    { data: 'brand' },
                    { data: 'stock' },
                    { data: 'cost' },
                    { data: 'retencion' },
                    { data: 'flete' },
                    { data: 'IVA' },
                    { data: 'cost_with_taxes' },
                    { data: 'utility' },
                    { data: 'price' },
                    { data: 'discount' },
                    { data: 'price_with_discount' },
                    { data: 'rentability' },
                    { data: 'details' },
                    { data: 'updated_by' },
                    { data: 'created_at' },
                    { data: 'updated_at' }
                ]
            })
        </script>
    @endpush
</x-app-layout>