<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Crear Marca') }}
        </h2>
    </x-slot>
    <form action="{{ route('brands.store') }}" method="POST">
        @csrf
        <x-input-group
            name="name"
            label="Nombre"
            required="true"
        />
        <x-primary-button type="submit">Guardar</x-primary-button>
    </form>
</x-app-layout>