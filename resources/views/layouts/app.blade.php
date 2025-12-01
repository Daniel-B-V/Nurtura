<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="user-id" content="{{ Auth::id() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .app-container {
                display: flex;
                min-height: 100vh;
            }
            
            .sidebar-wrapper {
                width: 16rem;
                flex-shrink: 0;
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                z-index: 40;
            }
            
            .main-content {
                flex: 1;
                margin-left: 16rem;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }
            
            .topnav {
                position: sticky;
                top: 0;
                z-index: 30;
                background: white;
                border-bottom: 1px solid #e5e7eb;
            }
            
            .page-content {
                flex: 1;
                overflow-y: auto;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="app-container">
            <!-- Sidebar -->
            <div class="sidebar-wrapper">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content Area -->
            <div class="main-content">
                <!-- Top Navigation -->
                @include('layouts.topnav')

                <!-- Page Content -->
                <main class="page-content p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>