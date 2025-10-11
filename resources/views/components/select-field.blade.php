<div>
    <x-input-label :for="$name" :value="__($label)" />
    <select 
        name="{{ $name }}" 
        id="{{ $name }}"
        {{ $attributes->merge(['class' => 'bg-green'])}}
    >
        @foreach($options as $value => $text)
            <option value="{{ $value }}" {{ old($name) == $value ? 'selected' : ''}}>
                {{ $text }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get($name)" />
</div>