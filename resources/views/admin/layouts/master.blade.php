<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts & Material Icons -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Tailwind CSS & Chart.js Play CDNs -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @stack('css')
</head>

<body class="h-full text-slate-700 antialiased flex flex-col overflow-hidden">

    <!-- TOP NAVBAR -->
    <header class="bg-white border-b border-slate-200 h-16 min-h-16 flex items-center justify-between px-4 lg:px-6 z-30 static shrink-0">
        <div class="flex items-center gap-3">
            <!-- Mobile Sidebar Burger Menu -->
            <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-md text-gray-500 hover:bg-slate-100 focus:outline-none">
                <i class="material-icons">menu</i>
            </button>
            <a class="text-xl font-bold tracking-wider text-blue-600 uppercase" href="{{ url('/') }}">
                POS Inventory
            </a>
        </div>
        
        <!-- Navbar Right Actions -->
        <div class="flex items-center gap-4">
            @include('admin.includes.notification')
        </div>
    </header>

    <!-- MAIN BODY WRAPPER -->
    <div class="flex flex-1 overflow-hidden relative">
        
        <!-- LEFT SIDEBAR CONTAINER -->
        <!-- Toggle logic controls 'hidden' / 'flex' on mobile -->
        <aside id="sidebar-menu" class="hidden lg:flex flex-col w-64 bg-slate-900 text-slate-300 absolute lg:relative inset-y-0 left-0 z-40 transform lg:transform-none transition-transform duration-300 border-r border-slate-800 shrink-0">
            @include('admin.includes.sidebar')
        </aside>

        <!-- BACKDROP FOR MOBILE SIDEBAR -->
        <div id="sidebar-backdrop" onclick="toggleSidebar()" class="hidden fixed inset-0 bg-slate-900/40 z-30 lg:hidden"></div>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 overflow-y-auto p-4 lg:p-8 focus:outline-none">
            @yield('content')
        </main>
        
    </div>

    <!-- GLOBAL SIDEBAR TOGGLE SCRIPT -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar-menu');
            const backdrop = document.getElementById('sidebar-backdrop');
            
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                sidebar.classList.add('flex', 'fixed', 'h-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('flex', 'fixed', 'h-full');
                backdrop.classList.add('hidden');
            }
        }
    </script>

    @stack('js')
</body>
</html>