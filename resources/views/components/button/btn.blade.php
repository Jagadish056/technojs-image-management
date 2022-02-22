<button
    {{ $attributes->merge(['class' =>'btn px-4 py-3.5 text-sm text-white dark:text-inherit bg-blue-600 hover:bg-blue-700 dark:bg-blue-800 font-medium leading-tight rounded shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out']) }}>{{ $slot }}</button>
