<input
    @error(str($attributes->get('name'))->remove('[]')) {{ $attributes->merge(['class' =>'block w-full px-3 py-2 text-sm text-gray-700 bg-white bg-clip-padding border-2 border-solid rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none invalid']) }} @else 
    {{ $attributes->merge(['class' =>'block w-full px-3 py-2 text-sm text-gray-700 bg-white bg-clip-padding border-2 border-solid rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none']) }} @enderror />
