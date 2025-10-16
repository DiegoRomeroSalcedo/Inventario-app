@props([
    'name',
    'label',
    'options' => [],
    'selected' => null,
    'required' => false
])

<div>
    <x-input-label :for="$name" :value="$label" />

    <select 
        name="{{ $name }}" 
        id="{{ $name }}" 
        {{ $required ? 'required' : '' }}
        class="border rounded-lg p-2"
    >
        @foreach($options as $value => $text)
            <option value="{{ $value }}" 
                {{ $value == old($name, $selected) ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
