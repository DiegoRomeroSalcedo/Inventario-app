<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Crear Marca') }}
        </h2>
    </x-slot>
    <form action="{{ route('brands.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <x-input-group
                name="name"
                label="Nombre"
                required="true"
            />
        </div>
        <div class="flex justify-center pt-4">
            <x-primary-button type="submit">Guardar</x-primary-button>
        </div>
    </form>
</x-app-layout>