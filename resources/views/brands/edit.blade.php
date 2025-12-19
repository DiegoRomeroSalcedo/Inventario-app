<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Actualizar marca') }}
        </h2>
    </x-slot>
    <form action="{{ route('brands.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="dark:text-white grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <x-input-group
                name="name"
                label="Nombre"
                required="true"
                value="{{ old('name', $data->name) }}"
            />
        </div>
        <div class="flex justify-center pt-4">
            <x-primary-button type="submit">Actualizar</x-primary-button>
        </div>
        
    </form>
</x-app-layout>