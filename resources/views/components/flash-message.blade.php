@if (session('feedback'))
    <div
        class="flash flex flex-col justify-center fixed top-0 right-0 transition duration-500 ease-in-out transform translate-y-4 -translate-x-4 hover:scale-105 z-50">
        <div @class([
            'w-72 max-w-full mx-auto mb-3 px-6 py-3 text-sm text-white bg-blue-600 border-blue-500 bg-clip-padding rounded-lg shadow-lg pointer-events-auto',
            'bg-red-500 border-red-600' => session('feedback.type') === 'error',
            'bg-green-600 border-green-500' => session('feedback.type') === 'success',
        ]) role="alert">
            <div
                class="pb-2 bg-inherit bg-clip-padding border-b border-inherit rounded-t-lg flex justify-between items-center">
                <p class="my-0 font-bold capitalize flex items-center">{{ session('feedback.type') }}!</p>
                <div class="flex items-center">
                    <p class="my-0 opacity-90 text-xs">{{ now()->calendar() }}</p>
                    <x-svg.solid.x class="w-3 h-3 ml-3" onclick="this.closest('.flash').remove()" />
                </div>
            </div>
            <div class="pt-2 bg-inherit rounded-b-lg break-words">{{ session('feedback.text') }}</div>
        </div>
    </div>
@endif
