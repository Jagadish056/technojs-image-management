@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section>
        <x-container-fluid>
            <div class="mb-4 -mt-6 flex flex-wrap justify-between gap-4">
                <div class="my-auto dropdown relative">
                    <x-button.btn class="dropdown-toggle !p-0 text-inherit !bg-transparent !shadow-none flex ">
                        <span> Sort by</span>
                        <x-svg.solid.arrow-triangle class="h-4 w-4 -rotate-90" />
                    </x-button.btn>
                    <ul
                        class="hidden dropdown-menu list-none min-w-max m-0 ml-1 text-sm bg-white border-none text-left  shadow-lg absolute top-0 left-16 z-50">
                        <li><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'latest']) }}"
                                class="inline-block px-4 py-2 w-full hover:bg-gray-100">Date added (latest)</a> </li>
                        <li><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'oldest']) }}"
                                class="inline-block px-4 py-2 w-full hover:bg-gray-100">Date added (oldest)</a> </li>
                    </ul>
                </div>
                @if (Route::has('home'))
                    <form action="{{ route('home') }}" method="GET" class="flex">
                        <x-form.input type="search" class="sm:w-56 py-1.5 border-r-0 border-blue-500 rounded-r-none"
                            name="for" value="{{ old('for', request()->input('for') ?? '') }}" placeholder="Search.."
                            required />
                        <x-button.btn type="submit" class="my-auto px-3 !py-2 rounded-l-none">
                            <x-svg.solid.search class="w-5 h-5" />
                        </x-button.btn>
                    </form>
                @endif
            </div>
        </x-container-fluid>
    </section>
    <section id="images">
        <x-container-fluid>
            <div class="mb-4 grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 overflow-hidden">
                @forelse ($images as $img)
                    <div class="max-w-sm bg-white shadow-lg rounded-sm justify-self-center sm:justify-self-auto">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ url($img->path) }}" alt="{{ $img->name }}"
                                class="object-scale-down bg-zinc-900">
                        </div>
                        <div class="px-4 py-2 my-auto  group">
                            <x-link href="{{ url($img->path) }}" class="text-xs break-words ">
                                {{ url($img->path) }}
                            </x-link>
                            <x-button.btn
                                class="clipboard !p-0 text-inherit !bg-transparent !shadow-none hidden group-hover:inline-flex align-middle"
                                onclick="clipboard(event, '{{ url($img->path) }}')">
                                <x-svg.outline.clipboard class="!h-4 !w-4 text-gray-300" />
                                <span class="sr-only">Copy to clipboard</span>
                                <x-svg.outline.clipboard-check class="hidden !h-4 !w-4 text-green-600" />
                            </x-button.btn>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>

            {{ $images->links() }}

        </x-container-fluid>
    </section>
    <script>
        function clipboard(e, text) {
            const btn = e.target.parentElement;

            let input = document.createElement("input");
            input.value = text;
            document.body.appendChild(input);
            input.select();

            let result = document.execCommand("copy");
            document.body.removeChild(input);

            if (result) {
                document.querySelectorAll(".clipboard").forEach((elem) => {
                    if (elem == btn) {
                        elem.firstElementChild.classList.add('hidden');
                        elem.lastElementChild.classList.remove('hidden');
                    } else {
                        elem.firstElementChild.classList.remove('hidden');
                        elem.lastElementChild.classList.add('hidden');
                    }
                });
            }

            // ALTERNATIVE WAY: navigator.clipboard.writeText("Your text");
        }
    </script>
@endsection
