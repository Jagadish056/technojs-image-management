@extends('layouts.app')

@section('title', 'Upload Image')

@section('content')
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
