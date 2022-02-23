@extends('layouts.app')

@section('title', 'Upload Image')

@section('content')
    @if (count(Cache::get('images', [])) > 7)
        <x-container-fluid class="hidden md:block mb-10">
            <x-card.default
                class="mx-auto max-w-4xl px-8 py-3 bg-gradient-to-r from-slate-900 via-sky-600 to-slate-900 !rounded-full !overflow-hidden">
                <div class="grid grid-cols-3 sm:grid-cols-5 md:grid-cols-7 gap-2 relative">
                    @foreach (Cache::get('images', [])->random(7) as $img)
                        <div class="w-24 h-14 place-self-center even:invisible lg:even:visible">
                            @if ($loop->first)
                                <x-svg.solid.arrow-triangle
                                    class="-ml-0.5 mt-0.5 cursor-text text-gray-300 -rotate-90 absolute top-4 -left-6" />
                            @endif
                            <a href="{{ url($img->path) }}" target="_blank">
                                <div class="aspect-w-16 aspect-h-9">
                                    <img src="{{ url($img->path) }}" alt="{{ $img->name }}"
                                        class="text-sm object-scale-down bg-zinc-700 rounded-md">
                                </div>
                            </a>
                            @if ($loop->last)
                                <x-svg.solid.arrow-triangle
                                    class="-mr-0.5 mt-0.5 cursor-text text-gray-300 rotate-90 absolute top-4 -right-6" />
                            @endif
                        </div>
                    @endforeach
            </x-card.default>
            </div>
        </x-container-fluid>
    @endif
    <x-card.lg>
        <x-slot name="header">
            <h4 class="font-bold text-sm">Upload Image</h4>
        </x-slot>
        <form action="{{ route('image.store') }}" method="POST" class="space-y-2.5" enctype="multipart/form-data">
            @csrf
            <div>
                <x-form.label>Select the picture from your device</x-form.label>
                <x-form.input type="file" id="image" name="image[]" accept=".jpeg, .jpg, .png, .gif, .bmp, .webp" multiple
                    required />
                @error('image')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div id="image-preview-container" class="flex flex-wrap justify-center items-center gap-4"></div>
            <x-button.btn type="submit" class="w-full uppercase">Submit</x-button.btn>
        </form>
    </x-card.lg>
@endsection
