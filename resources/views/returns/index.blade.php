<x-app-layout>
    <x-slot name="header">
        {{ __('Listado de Devoluciones')}}
    </x-slot>

    <x-primary-button>
        <a href="{{ route('returns.create') }}">Crear Producto</a>
    </x-primary-button>
    <div>
        <div>
            <table id="returns-table" class="display">
                <thead>
                    <tr>
                        <th>Esta es una celda</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</x-app-layout>