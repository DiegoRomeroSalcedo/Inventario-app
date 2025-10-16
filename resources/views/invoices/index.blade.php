<x-app-layout>
    <x-slot name="header">
        {{ __('Listado de Facturas')}}
    </x-slot>
    <div>
        <div>
            <table id="invoices-table" class="display">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Total Venta</th>
                        <th>Total Descuento</th>
                        <th>Valor Recivido</th>
                        <th>Valor Devuelto</th>
                        <th>Método de Pago</th>
                        <th>Cliente</th>
                        <th>Creador</th>
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
            new DataTable('#invoices-table', {
                processing: true,
                serverSide: true,
                ajax: "{{ route('invoices.getJsonToInvoices') }}",
                columns: [
                    {
                        data: 'id',
                        render: function(data) {
                            return `<a href="{{ url('invoices')}}/${data}">${data}</a>`
                        },
                        searchable: true,
                        orderable: true
                    },
                    { data: 'total_sale' },
                    { data: 'total_discount' },
                    { data: 'received_amount' },
                    { data: 'change_amount' },
                    { data: 'payment_method' },
                    { data: 'client_name' },
                    { data: 'user_id' },
                    { data: 'created_at' }
 
                ]
            })
        </script>
    @endpush
</x-app-layout>