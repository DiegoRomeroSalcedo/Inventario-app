@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-900 dark:border-gray-400 dark:bg-[#181818] dark:text-white focus:border-gray-700 rounded-md']) }}>
