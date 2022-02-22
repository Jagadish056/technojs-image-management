@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <x-card.lg>
        <strong>Hi, {{ auth()->user()->name }}</strong>
        <p>This is dashboard page.</p>
    </x-card.lg>
@endsection
