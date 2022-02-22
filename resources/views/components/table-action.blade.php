@props(['get', 'post', 'delete', 'text' => '', 'confirmation' => ''])

<div {{ $attributes->merge(['class' => 'flex justify-center space-x-2 font-medium']) }}>
    @isset($get)
        <form action="{{ $get }}" method="GET">
            <x-button.btn type="submit" title="Edit" class="!p-1.5 hover:scale-110">
                <x-svg.solid.pencil-alt class="h-4 w-4" />
                <span class="hidden">Edit</span>
            </x-button.btn>

        </form>
    @endisset

    @isset($post)
        <form action="{{ $post }}" method="POST" onsubmit="return confirm('{{ $text }}');">
            @csrf
            <x-button.btn type="submit" title="Add"
                class="!p-1.5 bg-green-600 hover:!bg-green-700 focus:!bg-green-700 hover:scale-110">
                <x-svg.outline.duplicate class="!h-4 !w-4" />
                <span class="hidden">Add</span>
            </x-button.btn>
        </form>
    @endisset

    @isset($delete)
        <form action="{{ $delete }}" method="POST" onsubmit="return confirm('{{ $confirmation }}');">
            @csrf
            @method('delete')
            <x-button.btn type="submit" title="Delete"
                class="!p-1.5 bg-red-600 hover:!bg-red-700 focus:!bg-red-700 hover:scale-110">
                <x-svg.solid.trash class="h-4 w-4" />
                <span class="hidden">Delete</span>
            </x-button.btn>
        </form>
    @endisset


    {{ $slot }}
</div>
