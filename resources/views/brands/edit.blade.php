<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Actualizar marca') }}
        </h2>
    </x-slot>
    <form action="{{ route('brands.update') }}" method="POST">
        @csrf
        @method('PUT')
        <x-input-group
            name="name"
            label="Nombre"
            required="true"
            value="{{ old('name', $data->name) }}"
        />
        <x-primary-button type="submit">Actualizar</x-primary-button>
    </form>
</x-app-layout>