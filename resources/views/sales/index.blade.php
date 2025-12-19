<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Ventas') }}
        </h2>

        <div class="mb-6">
            <x-primary-button>
                <a href="{{ route('sales.create') }}">Insertar Venta</a>
            </x-primary-button>
        </div>
        <div>
        <div class="dark:text-white">
            <table id="sales-table" class="display">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Código de factura</th>
                        <th>Nombre de producto</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Precio final</th>
                        <th>Descuento</th>
                        <th>Total</th>
                        <th>Creado por</th>
                        <th>Acturalizado por</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
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
            new DataTable("#sales-table", {
                processing: true,
                serverSide: true,
                ajax: "{{ route('sales.getJsonToSales')}}",
                columns: [
                    {
                        data: 'id',
                        render: function(data) {
                            return `<a href="{{ url('sales')}}/${data}">${data}</a>`
                        },
                        searchable: true,
                        orderable: true
                    },
                    { data: 'invoice_id' },
                    { data: 'product_name' },
                    { data: 'quantity' },
                    { data: 'unity_price' },
                    { data: 'price_with_discount' },
                    { data: 'discount' },
                    { data: 'sale_amount' },
                    { data: 'created_by' },
                    { data: 'updated_by' },
                    { data: 'created_at' },
                    { data: 'updated_at' },
                ]
            })
        </script>
    @endpush
</x-app-layout>