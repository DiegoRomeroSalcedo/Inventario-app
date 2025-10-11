<div>
    <x-input-label 
        :for="$name" 
        :value="$label"
    />
    <x-text-input 
        :id="$name"
        :type="$type"
        :name="$name"
        :value="old($name, $value)"
        :required="$required"
        autocomplete="{{ $name }}"
    />
    <x-input-error 
        :messages="$errors->get($name)" class="mt-2" 
    />
</div>