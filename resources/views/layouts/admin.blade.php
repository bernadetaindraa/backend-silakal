<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    {{-- TAILWIND --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1D2059',
                        accent: '#A68549',
                        background: '#F5F7FB',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    {{-- ALPINE --}}
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

    <style>

        [x-cloak] {
            display: none !important;
        }

        body {
            overflow: hidden;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 20px;
        }

    </style>

</head>

<body
    class="bg-background font-sans text-gray-700"
    x-data="{
        sidebarOpen: false,
        sidebarMini: false,
        profileOpen: false
    }"
>

@php

    $user = auth()->user();

    $roleId = $user->role_id ?? null;

    if ($roleId == 1) {
        $dashboardRoute = route('admin.dashboard');
        $roleName = 'Administrator';
    } elseif ($roleId == 2) {
        $dashboardRoute = route('pelayanan.dashboard');
        $roleName = 'Pelayanan';
    } else {
        $dashboardRoute = route('dukuh.dashboard');
        $roleName = 'Dukuh';
    }

    $sidebarMenus = config('sidebar');

@endphp

<div class="flex h-screen overflow-hidden">

    {{-- OVERLAY MOBILE --}}
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        x-cloak
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 lg:hidden"
    ></div>

    {{-- SIDEBAR --}}
    <aside
        :class="[
            sidebarOpen ? 'translate-x-0' : '-translate-x-full',
            sidebarMini ? 'lg:w-24' : 'lg:w-72'
        ]"
        class="
            fixed lg:static
            inset-y-0 left-0
            z-50
            w-72
            bg-white
            border-r border-gray-200
            transform
            transition-all duration-300
            lg:translate-x-0
            flex flex-col
            shadow-xl lg:shadow-none
        "
    >

        {{-- LOGO --}}
        <div class="h-16 px-4 border-b border-gray-100 flex items-center justify-between">

            <div class="flex items-center gap-3 overflow-hidden">

                <div class="w-11 h-11 flex items-center justify-center shrink-0">

                    <img
                        src="{{ asset('images/logo-kabupaten.png') }}"
                        class="w-7 h-7 object-contain"
                        alt="Logo"
                    >

                </div>

                <div
                    x-show="!sidebarMini"
                    x-transition
                    class="leading-tight"
                >

                    <h1 class="text-sm font-bold text-primary tracking-tight">
                        Pemerintah Kalurahan
                    </h1>

                    <p class="text-xs font-medium text-accent">
                        Hargobinangun
                    </p>

                </div>

            </div>

            {{-- DESKTOP TOGGLE --}}
            <button
                @click="sidebarMini = !sidebarMini"
                class="hidden lg:flex w-9 h-9 rounded-xl hover:bg-gray-100 items-center justify-center"
            >

                <svg
                    class="w-5 h-5 text-gray-500"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />

                </svg>

            </button>

            {{-- CLOSE MOBILE --}}
            <button
                @click="sidebarOpen = false"
                class="lg:hidden w-9 h-9 rounded-xl hover:bg-gray-100 flex items-center justify-center"
            >

                <svg
                    class="w-5 h-5 text-gray-500"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />

                </svg>

            </button>

        </div>

        {{-- MENU --}}
        <div class="flex-1 overflow-y-auto px-4 py-5 space-y-6">

            @foreach($sidebarMenus as $section)

                @php
                    $filteredItems = collect($section['items'])->filter(function ($item) use ($roleId) {
                        return in_array($roleId, $item['roles']);
                    });
                @endphp

                @if($filteredItems->count())

                    <div>

                        {{-- TITLE --}}
                        <h3
                            x-show="!sidebarMini"
                            x-transition
                            class="text-[11px] uppercase text-gray-400 font-semibold mb-2 px-2 tracking-wider"
                        >

                            {{ $section['title'] }}

                        </h3>

                        {{-- ITEMS --}}
                        <div class="space-y-1.5">

                            @foreach($filteredItems as $item)

                                @php
                                    $isActive =
                                        request()->routeIs($item['route']) ||
                                        request()->routeIs($item['route'] . '.*');
                                @endphp

                                <a
                                    href="{{ route($item['route']) }}"
                                    class="
                                        flex items-center
                                        gap-3
                                        px-4 py-3
                                        rounded-2xl
                                        text-sm font-medium
                                        transition-all duration-200

                                        {{ $isActive
                                            ? 'bg-primary text-white shadow-sm'
                                            : 'text-gray-600 hover:bg-gray-100'
                                        }}
                                    "
                                >

                                    <svg
                                        class="w-5 h-5 shrink-0"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        {!! $item['icon'] !!}
                                    </svg>

                                    <span
                                        x-show="!sidebarMini"
                                        x-transition
                                        class="truncate"
                                    >
                                        {{ $item['label'] }}
                                    </span>

                                </a>

                            @endforeach

                        </div>

                    </div>

                @endif

            @endforeach

        </div>

        {{-- FOOTER --}}
        <div class="p-4 border-t border-gray-100">

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button
                    type="submit"
                    class="
                        w-full
                        bg-red-50
                        hover:bg-red-100
                        text-red-600
                        text-sm font-semibold
                        py-3
                        rounded-2xl
                        transition
                    "
                >

                    <span x-show="!sidebarMini">
                        Logout
                    </span>

                    <span x-show="sidebarMini">
                        ⎋
                    </span>

                </button>

            </form>

        </div>

    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col overflow-hidden min-w-0">

        {{-- HEADER --}}
        <header
            class="
                h-16
                bg-white/90
                backdrop-blur
                border-b border-gray-200
                px-4 sm:px-6
                flex items-center justify-between
                sticky top-0
                z-30
            "
        >

            {{-- LEFT --}}
            <div class="flex items-center gap-4">

                {{-- MOBILE HAMBURGER --}}
                <button
                    @click="sidebarOpen = true"
                    class="
                        lg:hidden
                        w-10 h-10
                        rounded-xl
                        hover:bg-gray-100
                        flex items-center justify-center
                        transition
                    "
                >

                    <svg
                        class="w-6 h-6 text-primary"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                    </svg>

                </button>

                {{-- TITLE --}}
                <div>

                    <h2 class="text-lg font-bold text-primary">
                        @yield('page-title', 'Dashboard')
                    </h2>

                    <p class="text-xs text-gray-500">
                        {{ $roleName }}
                    </p>

                </div>

            </div>

            {{-- PROFILE --}}
            <div
                class="relative"
                @click.away="profileOpen = false"
            >

                <button
                    @click="profileOpen = !profileOpen"
                    class="flex items-center gap-3"
                >

                    <div class="hidden md:block text-right">

                        <h4 class="text-sm font-semibold text-primary">
                            {{ $user->nama_lengkap ?? 'User' }}
                        </h4>

                        <p class="text-xs text-gray-500">
                            {{ $roleName }}
                        </p>

                    </div>

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($user->nama_lengkap ?? 'User') }}&background=1D2059&color=fff"
                        class="w-10 h-10 rounded-full border border-gray-200"
                        alt="Avatar"
                    >

                </button>

                {{-- DROPDOWN --}}
                <div
                    x-show="profileOpen"
                    x-transition
                    x-cloak
                    class="
                        absolute right-0 mt-3
                        w-56
                        bg-white
                        border border-gray-100
                        rounded-2xl
                        shadow-xl
                        overflow-hidden
                    "
                >

                    <a
                        href="{{ route('admin.profile.index') }}"
                        class="block px-4 py-3 text-sm hover:bg-gray-50"
                    >
                        Profil Saya
                    </a>

                </div>

            </div>

        </header>

        {{-- CONTENT --}}
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 bg-background">

            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl text-sm">

                    {{ session('success') }}

                </div>

            @endif

            {{-- ERROR --}}
            @if(session('error'))

                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl text-sm">

                    {{ session('error') }}

                </div>

            @endif

            {{-- VALIDATION --}}
            @if($errors->any())

                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl text-sm">

                    <ul class="list-disc pl-5 space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- PAGE CONTENT --}}
            @yield('content')

        </main>

    </div>

</div>

</body>
</html>