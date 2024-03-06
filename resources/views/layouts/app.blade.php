<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;1,400;1,700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-lora antialiased bg-base-content text-sm">
    <div x-data="{ isLoading: true }" x-init="() => { setTimeout(() => { isLoading = false; }, 2000); }">
        <template x-if="isLoading">
            <div id="loading-spinner" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
                <div>
                    <img src="{{asset('../assets/images/loading.gif')}}" alt="">
                </div>
            </div>
        </template>
    </div>
    
    <div x-data="{ isOpen: true }" class="flex flex-col relative min-h-screen">
        <!-- Navbar -->
        @include('components.partials.navbar')
        
        <!-- Sidebar -->
        @include('components.partials.sidebar')
        
        <!-- Main Content -->
        <main :class="{'ml-64 pt-28': isOpen, 'ml-24 pt-16': !isOpen}" class="p-4 min-h-screen mb-20">
            <!-- Your page content here -->
            @yield('content')
            
        </main>

        <!-- Footer -->
        @include('components.partials.footer')
        
    </div>
    @livewireScripts
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('scripts')
</body>
</html>
