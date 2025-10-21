<x-app-layout>
    <x-slot name="header">
        {{ __('Listado de Devoluciones')}}
    </x-slot>
    <div class="mb-6">
        <x-primary-button>
            <a href="{{ route('returns.create') }}">Crear Devolución</a>
        </x-primary-button>
    </div>
    <div>
        <div>
            <table id="returns-table" class="display">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Código de Devolucion</th>
                        <th>Código de Factura</th>
                        <th>Código de Venta</th>
                        <th>Nombre de Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Observaciones</th>
                        <th>Usuario de creación</th>
                        <th>Fecha de Creación</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.3.2/js/dataTables.tailwindcss.js"></script>

        <script>
            new DataTable('#returns-table', {
                processing: true,
                serverSide: true,
                ajax: "{{ route('returns.getJsonToSalesReturn')}}",
                columns: [
                    { data: 'id' },
                    { data: 'sale_return_id' },
                    { data: 'invoice_id' },
                    { data: 'sale_id' },
                    { data: 'product_name' },
                    { data: 'quantity' },
                    { data: 'unit_price' },
                    { data: 'total' },
                    { data: 'observation'},
                    { data: 'created_by'},
                    { data: 'created_at'},
                ]

            })
        </script>
    @endpush
</x-app-layout>