<a {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white 
border border-gray-500 rounded-md font-semibold text-xs text-black uppercase tracking-widest 
shadow-sm hover:bg-gray-200 
 transition ease-in-out duration-300']) }}>
    {{ $slot }}
</a>
