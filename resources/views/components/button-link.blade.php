<a {{ $attributes->merge([
    'class' => 'inline-flex items-center px-4 py-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
    'style' => 'width: 20%; display: flex; justify-content: center; height: 6rem;' // Ajusta el valor de height según tu preferencia
]) }}>
    {{ $slot }}
</a>


