@extends('layouts.app')

@section('title', 'List of Images')

@section('content')

    <x-card.lg class="px-4 max-w-4xl">
        <x-slot name="header">
            <div class="mb-1 text-left text-sm font-bold">Images ({{ $images->total() }})</div>
            <x-link href="{{ route('image.create') }}" class="text-xs text-left flex items-center">
                <x-svg.solid.link class="h-4 w-4" />
                <span class="ml-1">Upload Image</span>
            </x-link>
        </x-slot>
        <div class="overflow-x-auto">
            <table>
                <thead class="table-header-group">
                    <tr class="table-row">
                        <th scope="col">S.N.</th>
                        <th scope="col">Name</th>
                        <th scope="col" class="hidden md:table-cell">Details</th>
                        <th scope="col" class="hidden sm:table-cell">Preview</th>
                        @cannot('is-guest')
                            <th scope="col">Actions</th>
                        @endcannot
                    </tr>
                </thead>
                <tbody>
                    @forelse ($images as $img)
                        <tr class="table-row bg-white hover:bg-gray-100 even:bg-zinc-50">
                            <td class="text-center">
                                {{ $loop->iteration }}
                                <span class="hidden">ID: {{ $img->id }}</span>
                            </td>
                            <td>
                                {{ $img->name }}
                                <x-link href="{{ url($img->path) }}" class="block">{{ url($img->path) }}
                                </x-link>
                            </td>
                            <td class="whitespace-nowrap hidden md:table-cell">
                                Size: {{ formatBytes($img->size) }}<br />
                                Author: {{ $img->user->name }}<br />
                                Created: {{ $img->created_at->diffForHumans() }}
                            </td>
                            <td class="hidden sm:table-cell">
                                <img src="{{ $img->path }}" alt="{{ $img->name }}" class="mx-auto w-20">
                            </td>
                            @can('delete', $img)
                                <td>
                                    <x-table-action confirmation="Do you want to delete this image?"
                                        :delete="Route::has('image.destroy') ? route('image.destroy', $img) : null" />
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan=" @cannot('is-guest') 5 @else 4 @endcannot" class="text-center">No data
                                found.
                            </td>
                        </tr>
                </tbody>
                @endforelse

            </table>
        </div>
        {{ $images->links() }}
    </x-card.lg>


@endsection
