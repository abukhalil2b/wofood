<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex justify-center items-center p-1 h-10 bg-[#032a38] rounded border border-[#b1efe6] text-[#b1efe6] text-xs hover:bg-[#0f4f65] focus:bg-gray-700 active:bg-gray-900 focus:outline-none  transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
