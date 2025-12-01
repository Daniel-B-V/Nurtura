<aside class="w-64 h-full bg-white border-r border-gray-200 flex flex-col">
    <!-- Logo Section -->
    <div class="p-6 border-b border-gray-200 flex-shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full flex items-center justify-center bg-gradient-to-br from-emerald-400 to-blue-500">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
            <div>
                <div class="font-semibold text-gray-900">NURTURA</div>
                <div class="text-xs text-gray-500">Care Platform</div>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        <!-- Dashboard - Both Roles -->
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Children - Both Roles -->
        <a href="{{ route('children.index') }}" class="{{ request()->routeIs('children.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span class="font-medium">Children</span>
        </a>

        @can('admin')
            <!-- Donors & Volunteers - Admin Only -->
            <a href="{{ route('donors.index') }}" class="{{ request()->routeIs('donors.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="font-medium">Donors & Volunteers</span>
            </a>

            <!-- Inventory - Admin Only -->
            <a href="{{ route('inventory.index') }}" class="{{ request()->routeIs('inventory.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <span class="font-medium">Inventory</span>
            </a>

            <!-- Reports - Admin Only -->
            <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span class="font-medium">Reports</span>
            </a>

            <!-- Settings - Admin Only -->
            <a href="{{ route('settings.index') }}" class="{{ request()->routeIs('settings.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="font-medium">Settings</span>
            </a>
        @else
            <!-- My Tasks - User Only -->
            <a href="{{ route('user.tasks') }}" class="{{ request()->routeIs('user.tasks') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                <span class="font-medium">My Tasks</span>
            </a>

            <!-- My Activity - User Only -->
            <a href="{{ route('user.activity') }}" class="{{ request()->routeIs('user.activity') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">My Activity</span>
            </a>
        @endcan
    </nav>

    <!-- Platform Version -->
    <div class="p-4 border-t border-gray-200">
        <div class="text-xs text-gray-500">Platform Version</div>
        <div class="text-sm font-semibold text-emerald-600">v2.0.1 AI</div>
    </div>
</aside>