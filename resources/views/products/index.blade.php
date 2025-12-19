<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Productos') }}
        </h2>
    </x-slot>
    <div class="mb-6">
        <x-primary-button>
            <a href="{{ route('products.create') }}">Crear Producto</a>
        </x-primary-button>
    </div>
    <div>
        <div class="overflow-x-auto dark:text-white">
            <table id="products-table" class="display">
                <thead>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>NOMBRE</th>
                        <th>MARCA</th>
                        <th>INVENTARIO</th>
                        <th>COSTO</th>
                        <th>FLETE</th>
                        <th>RETENCION</th>
                        <th>IVA</th>
                        <th>COSTO FINAL</th>
                        <th>UTILIDAD</th>
                        <th>PRECIO VENTA</th>
                        <th>PRECIO VENTA FINAL</th>
                        <th>RENTABILIDAD</th>
                        <th>DETALLE</th>
                        <th>USUARIO ACTUALIZACIÓN</th>
                        <th>FECHA CREACIÓN</th>
                        <th>FECHA ACTUALIZACIÓN</th>
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
                            return `<a href="{{ url('products')}}/${data}/edit">${data}</a>`
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