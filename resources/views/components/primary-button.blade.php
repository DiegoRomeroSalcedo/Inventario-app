<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-blue-500 border border-gray-300 rounded-md font-semibold text-xs text-gray-900 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-100 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-200 dark:active:bg-gray-300 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
