@props(['header'])

<x-card.default {{ $attributes->merge(['class' => 'card max-w-lg mx-auto']) }}>
    @isset($header)
        <div class="mb-4 py-3 text-center border-b border-gray-100 dark:border-gray-700">
            {{ $header }}
        </div>
    @endisset
    <div class="px-2">
        {{ $slot }}
    </div>
</x-card.default>
