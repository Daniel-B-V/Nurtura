<x-app-layout>
    <!-- Header Section -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Children Management</h1>
            <p class="text-gray-600 text-sm mt-1">Manage and monitor all children in care</p>
        </div>
        @can('admin')
            <a href="{{ route('children.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-400 to-blue-500 hover:from-emerald-500 hover:to-blue-600 text-white font-semibold rounded-lg transition-all shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Child
            </a>
        @endcan
    </div>

    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Children -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Children</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_children'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Good Health -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Good Health</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['good_health_percentage'] }}%</p>
                    </div>
                </div>
            </div>

            <!-- In School -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">In School</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['in_school_percentage'] }}%</p>
                    </div>
                </div>
            </div>

            <!-- Need Attention -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Need Attention</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['need_attention_count'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Bar -->
        <div class="bg-white rounded-xl p-4 shadow-sm" x-data="{
            searchQuery: '',
            selectedStatus: 'all',
            showFilterDropdown: false,
            filterHealth: 'all',
            filterAge: 'all'
        }">
            <div class="flex items-center gap-4">
                <div class="flex-1 relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input
                        type="text"
                        x-model="searchQuery"
                        @input="filterChildren()"
                        placeholder="Search by name, age, or ID..."
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border-0 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-colors">
                </div>

                <!-- Filter Button with Dropdown -->
                <div class="relative">
                    <button
                        @click="showFilterDropdown = !showFilterDropdown"
                        class="flex items-center gap-2 px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                        :class="{ 'bg-emerald-50 border-emerald-500': showFilterDropdown }">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Filter</span>
                        <svg class="w-4 h-4 text-gray-500 transition-transform" :class="{ 'rotate-180': showFilterDropdown }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Filter Dropdown -->
                    <div
                        x-show="showFilterDropdown"
                        @click.away="showFilterDropdown = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 z-10"
                        style="display: none;">
                        <div class="p-4 space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Health Status</label>
                                <select x-model="filterHealth" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500">
                                    <option value="all">All Health Status</option>
                                    <option value="excellent">Excellent</option>
                                    <option value="good">Good</option>
                                    <option value="fair">Fair</option>
                                    <option value="needs_attention">Needs Attention</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Age Range</label>
                                <select x-model="filterAge" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500">
                                    <option value="all">All Ages</option>
                                    <option value="0-5">0-5 years</option>
                                    <option value="6-12">6-12 years</option>
                                    <option value="13-17">13-17 years</option>
                                    <option value="18+">18+ years</option>
                                </select>
                            </div>
                            <div class="flex gap-2 pt-2">
                                <button
                                    @click="filterHealth = 'all'; filterAge = 'all'; selectedStatus = 'all'"
                                    class="flex-1 px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                                    Clear
                                </button>
                                <button
                                    @click="showFilterDropdown = false"
                                    class="flex-1 px-3 py-2 text-sm text-white bg-emerald-500 rounded-lg hover:bg-emerald-600">
                                    Apply
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <select
                    x-model="selectedStatus"
                    class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 transition-colors text-sm font-medium text-gray-700">
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="sponsored">Sponsored</option>
                    <option value="adopted">Adopted</option>
                    <option value="discharged">Discharged</option>
                </select>
            </div>
        </div>

        <!-- Children Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($children as $child)
                <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow">
                    <!-- Child Photo -->
                    <div class="relative h-64 bg-gradient-to-br from-gray-200 to-gray-300">
                        @if($child->photo)
                            <img src="{{ asset('storage/' . $child->photo) }}" alt="{{ $child->full_name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                        @endif

                        <!-- Status Badge -->
                        @php
                            $latestHealth = $child->healthRecords->first();
                            $healthStatus = $latestHealth->status ?? 'unknown';
                            $badgeColors = [
                                'good' => 'bg-emerald-500',
                                'excellent' => 'bg-blue-500',
                                'needs_attention' => 'bg-red-500',
                                'fair' => 'bg-yellow-500',
                            ];
                            $badgeText = [
                                'good' => 'Good',
                                'excellent' => 'Excellent',
                                'needs_attention' => 'Needs Attention',
                                'fair' => 'Fair',
                            ];
                        @endphp

                        @if($healthStatus === 'needs_attention')
                            <div class="absolute top-4 right-4 px-3 py-1 {{ $badgeColors[$healthStatus] ?? 'bg-gray-500' }} text-white text-xs font-semibold rounded-full">
                                {{ $badgeText[$healthStatus] ?? 'Unknown' }}
                            </div>
                        @endif
                    </div>

                    <!-- Child Info -->
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $child->full_name }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $child->age }} years • {{ ucfirst($child->gender) }}</p>

                        <div class="space-y-2">
                            <!-- Health Status -->
                            <div class="flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="text-gray-600">Health:</span>
                                <span class="px-2 py-0.5 {{ $badgeColors[$healthStatus] ?? 'bg-gray-500' }} text-white text-xs font-semibold rounded">
                                    {{ $badgeText[$healthStatus] ?? 'Unknown' }}
                                </span>
                            </div>

                            <!-- Education Status -->
                            @php
                                $latestEducation = $child->educationRecords->first();
                                $educationLevel = $latestEducation->current_grade_level ?? 'Not Enrolled';
                            @endphp
                            <div class="flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                                </svg>
                                <span class="text-gray-600">Education:</span>
                                <span class="text-gray-900 font-medium">{{ $educationLevel }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <svg class="mx-auto w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <p class="text-gray-500 text-lg font-medium">No children found</p>
                    <p class="text-gray-400 text-sm mt-1">Start by adding a new child to the system</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
