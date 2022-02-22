<button id="back-to-top" title="Back to top"
    {{ $attributes->merge(['class' =>'fixed bottom-5 right-6 p-2 text-white bg-red-500 rounded-full font-medium border-none outline-none focus:outline-none cursor-pointer z-50 transition duration-500 ease-in-out transform hover:scale-110']) }}>
    <x-svg.solid.chevron-up class="h-6 w-6" />
    <span class="sr-only">back to top</span>
</button>
