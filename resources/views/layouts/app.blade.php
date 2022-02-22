<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    {{-- <script defer src="{{ asset('vendor/alpinejs@3.9.0/cdn.min.js') }}"></script> --}}
</head>

<body @class([
    'bg-zinc-900' => ($isBodyDark = in_array(Route::currentRouteName(), [
        'login',
    ])),
    'bg-gray-200' => !$isBodyDark,
])>
    @if (!$isBodyDark)
        <nav class="py-6 text-sm text-white bg-zinc-900 font-medium ">
            <x-container-fluid>
                <div class="flex flex-wrap justify-between">
                    <x-link
                        href="{{ request()->route()->named('home') && auth()->check()? route('image.index'): url('/') }}"
                        class="!text-gray-200 no-underline">Image Management</x-link>
                    @guest
                        @if (Route::has('login'))
                            <x-link href="{{ route('login') }}" class="text-xs !text-gray-200 opacity-10">Login &raquo;
                            </x-link>
                        @endif
                    @else
                        @if (Route::has('logout'))
                            <div>

                                <x-link href="javascript:void(0)" class="text-xs !text-gray-200"
                                    onclick="this.nextElementSibling.submit()">Logout &raquo; </x-link>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </div>
                        @endif
                    @endguest
                </div>
            </x-container-fluid>
        </nav>
    @endif
    <x-flash-message />

    <main class="py-10">
        @yield('content')
    </main>

    <footer class="py-8 text-xs text-white bg-zinc-900 text-center font-medium ">
        <x-container-fluid>
            &copy; Copyright 2022 | All Rights Reserved | <a href="https://technojs.com"
                class="text-yellow-400 hover:text-yellow-500">technojs.com</a>
        </x-container-fluid>
    </footer>

    <x-back-to-top class="hidden" />

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
