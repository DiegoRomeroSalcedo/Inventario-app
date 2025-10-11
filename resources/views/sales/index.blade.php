<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Ventas') }}
        </h2>

        <x-primary-button>
            <a href="{{ route('sales.create') }}">Insertar Venta</a>
        </x-primary-button>
</x-app-layout>