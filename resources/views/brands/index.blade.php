<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Marcas')}}
        </h1>
    </x-slot>
    <div>
        <div>
            <table id="brands-table" class="display">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Usuario actualización</th>
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
    <x-primary-button>
        <a href="{{ route('brands.create') }}">Crear Marca</a>
    </x-primary-button>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.3.2/js/dataTables.tailwindcss.js"></script>

        <script>
            new DataTable("#brands-table", {
                processing: true,
                serverSide: true,
                ajax: "{{ route('brands.getJsonToIndex')}}",
                columns: [
                    {
                        data: 'id',
                        render: function(data) {
                            return `<a href="{{ url('brands')}}/${data}">${data}</a>`;
                        },
                        orderable: true,
                        searchable: true
                    },
                    { data: 'name' },
                    { data: 'updated_by' },
                    { data: 'created_at' },
                    { data: 'updated_at' }
                ]
            })
        </script>
    @endpush
</x-app-layout>