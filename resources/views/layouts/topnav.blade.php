<header class="bg-white border-b border-gray-200 sticky top-0 z-10" x-data="{ notificationOpen: false, userOpen: false }">
    <div class="px-6 py-4 flex items-center justify-between">
        <!-- Search Bar -->
        <div class="flex-1 max-w-2xl" x-data="{ searchOpen: false, searchQuery: '', searchResults: [] }">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    x-model="searchQuery"
                    @input="performSearch()"
                    @focus="searchOpen = true"
                    @keydown.escape="searchOpen = false; searchQuery = ''"
                    placeholder="Search children, donors, inventory..."
                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border-0 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-colors">

                <!-- Search Results Dropdown -->
                <div x-show="searchOpen && searchQuery.length > 0"
                     @click.away="searchOpen = false"
                     x-transition
                     class="absolute top-full left-0 right-0 mt-2 bg-white rounded-lg shadow-xl border border-gray-200 max-h-96 overflow-y-auto z-50"
                     style="display: none;">
                    <div x-show="searchResults.length === 0" class="px-4 py-8 text-center text-gray-500 text-sm">
                        <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <p>No results found</p>
                        <p class="text-xs text-gray-400 mt-1">Try searching for children, donors, or inventory items</p>
                    </div>

                    <template x-for="result in searchResults" :key="result.id">
                        <a :href="result.url" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-semibold"
                                     :class="{
                                         'bg-blue-500': result.type === 'child',
                                         'bg-emerald-500': result.type === 'donor',
                                         'bg-orange-500': result.type === 'inventory'
                                     }">
                                    <span x-text="result.icon"></span>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-900" x-text="result.name"></div>
                                    <div class="text-xs text-gray-500" x-text="result.subtitle"></div>
                                </div>
                                <div class="text-xs text-gray-400 px-2 py-1 bg-gray-100 rounded" x-text="result.type"></div>
                            </div>
                        </a>
                    </template>
                </div>
            </div>
        </div>

        <script>
            function performSearch() {
                const query = this.searchQuery.toLowerCase();
                if (query.length < 2) {
                    this.searchResults = [];
                    return;
                }

                // Perform AJAX search
                fetch(`/api/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        this.searchResults = data.results || [];
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        this.searchResults = [];
                    });
            }
        </script>

        <!-- Right Side: Notifications & User -->
        <div class="flex items-center gap-4 ml-6">
            <!-- Notifications -->
            <div class="relative">
                <button @click="notificationOpen = !notificationOpen" class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-1 right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-semibold">3</span>
                </button>

                <!-- Notification Dropdown -->
                <div x-show="notificationOpen" @click.away="notificationOpen = false" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 py-2" style="display: none;">
                    <div class="px-4 py-2 border-b border-gray-200">
                        <h3 class="font-semibold text-gray-900">Notifications</h3>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                            <div class="text-sm text-gray-900">New donation received</div>
                            <div class="text-xs text-gray-500 mt-1">2 hours ago</div>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                            <div class="text-sm text-gray-900">Inventory alert: Low stock</div>
                            <div class="text-xs text-gray-500 mt-1">5 hours ago</div>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                            <div class="text-sm text-gray-900">New volunteer registered</div>
                            <div class="text-xs text-gray-500 mt-1">1 day ago</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Profile -->
            <div class="relative">
                <button @click="userOpen = !userOpen" class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <div class="text-right">
                        <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</div>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 to-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </button>

                <!-- User Dropdown -->
                <div x-show="userOpen" @click.away="userOpen = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2" style="display: none;">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
