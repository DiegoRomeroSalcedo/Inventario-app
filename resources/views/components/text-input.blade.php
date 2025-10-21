@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-900 dark:border-gray-700 dark:bg-[#181818] dark:text-gray-300 focus:border-gray-700 rounded-md']) }}>
