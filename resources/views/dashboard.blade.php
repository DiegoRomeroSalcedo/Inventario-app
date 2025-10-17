<x-app-layout>
    <x-slot name="header">
        {{ __('Vista con React') }}
    </x-slot>

    <div id="react-root"></div>

    @viteReactRefresh
    @vite('resources/js/react/App.jsx')
</x-app-layout>
