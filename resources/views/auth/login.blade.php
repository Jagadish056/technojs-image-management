@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <x-card.lg class="max-w-md">
        <x-slot name="header">
            <p class="font-bold text-sm">Login your credentials to access content</p>
        </x-slot>
        <form class="space-y-4" action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <x-form.input type="email" id="email" name="email" placeholder="Email" required />
                @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative">
                <x-form.input type="password" id="password" name="password" placeholder=" Password" required />
                <x-password-toggler />
                @error('password')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <x-button.btn type="submit" class="w-full uppercase">Log In</x-button.btn>
        </form>
    </x-card.lg>
@endsection
