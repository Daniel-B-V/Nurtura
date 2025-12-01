<x-app-layout>
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}</h1>
        <p class="text-gray-600 text-sm mt-1">Here's what's happening with your orphanage today.</p>
    </div>

    <div class="space-y-6">
        <!-- Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Children -->
            <a href="{{ route('children.index') }}" class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow relative cursor-pointer group">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="text-3xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">{{ $stats['total_children'] }}</div>
                        <div class="text-gray-600 text-sm mt-2">Total Children</div>
                        <div class="text-emerald-600 text-xs mt-2">+3 this month</div>
                    </div>
                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="absolute top-4 right-16 text-emerald-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </a>

            <!-- Active Donors -->
            <a href="{{ route('donors.index') }}" class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow relative cursor-pointer group">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="text-3xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">{{ $stats['total_donors'] }}</div>
                        <div class="text-gray-600 text-sm mt-2">Active Donors</div>
                        <div class="text-emerald-600 text-xs mt-2">+12 this month</div>
                    </div>
                    <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                </div>
                <div class="absolute top-4 right-16 text-emerald-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </a>

            <!-- Monthly Donations -->
            <a href="{{ route('reports.index') }}" class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow relative cursor-pointer group">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="text-3xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors">${{ number_format($stats['total_donations_this_month'], 0) }}</div>
                        <div class="text-gray-600 text-sm mt-2">Monthly Donations</div>
                        <div class="text-emerald-600 text-xs mt-2">+18% from last month</div>
                    </div>
                    <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"/>
                        </svg>
                    </div>
                </div>
                <div class="absolute top-4 right-16 text-emerald-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </a>

            <!-- Inventory Items -->
            <a href="{{ route('inventory.index') }}" class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow relative cursor-pointer group">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="text-3xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors">1,248</div>
                        <div class="text-gray-600 text-sm mt-2">Inventory Items</div>
                        <div class="text-orange-600 text-xs mt-2">23 low stock</div>
                    </div>
                    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
                <div class="absolute top-4 right-16 text-emerald-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </a>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @can('admin')
                    <a href="{{ route('children.create') }}" class="flex flex-col items-center justify-center p-6 rounded-lg border-2 border-gray-100 hover:border-blue-500 hover:bg-blue-50 transition-all group">
                        <div class="w-14 h-14 bg-blue-500 rounded-xl flex items-center justify-center text-white mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Add New Child</span>
                    </a>
                @else
                    <div class="flex flex-col items-center justify-center p-6 rounded-lg border-2 border-gray-200 bg-gray-50 opacity-50 cursor-not-allowed">
                        <div class="w-14 h-14 bg-gray-400 rounded-xl flex items-center justify-center text-white mb-3">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-500">Add New Child</span>
                        <span class="text-xs text-gray-400 mt-1">Admin only</span>
                    </div>
                @endcan

                @can('admin')
                    <a href="{{ route('donors.create') }}" class="flex flex-col items-center justify-center p-6 rounded-lg border-2 border-gray-100 hover:border-emerald-500 hover:bg-emerald-50 transition-all group">
                        <div class="w-14 h-14 bg-emerald-500 rounded-xl flex items-center justify-center text-white mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Record Donation</span>
                    </a>
                @else
                    <div class="flex flex-col items-center justify-center p-6 rounded-lg border-2 border-gray-200 bg-gray-50 opacity-50 cursor-not-allowed">
                        <div class="w-14 h-14 bg-gray-400 rounded-xl flex items-center justify-center text-white mb-3">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-500">Record Donation</span>
                        <span class="text-xs text-gray-400 mt-1">Admin only</span>
                    </div>
                @endcan

                @can('admin')
                    <a href="{{ route('inventory.create') }}" class="flex flex-col items-center justify-center p-6 rounded-lg border-2 border-gray-100 hover:border-orange-500 hover:bg-orange-50 transition-all group">
                        <div class="w-14 h-14 bg-orange-500 rounded-xl flex items-center justify-center text-white mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Update Inventory</span>
                    </a>
                @else
                    <div class="flex flex-col items-center justify-center p-6 rounded-lg border-2 border-gray-200 bg-gray-50 opacity-50 cursor-not-allowed">
                        <div class="w-14 h-14 bg-gray-400 rounded-xl flex items-center justify-center text-white mb-3">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-500">Update Inventory</span>
                        <span class="text-xs text-gray-400 mt-1">Admin only</span>
                    </div>
                @endcan

                <button onclick="alert('Notification feature coming soon!')" class="flex flex-col items-center justify-center p-6 rounded-lg border-2 border-gray-100 hover:border-purple-500 hover:bg-purple-50 transition-all group">
                    <div class="w-14 h-14 bg-purple-500 rounded-xl flex items-center justify-center text-white mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Send Notification</span>
                </button>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - AI Insights and Donations -->
            <div class="lg:col-span-2 space-y-6">
                <!-- AI-Powered Insights -->
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">AI-Powered Insights</h2>
                        </div>
                        <span class="text-xs bg-purple-100 text-purple-600 px-3 py-1 rounded-full font-medium">{{ count($aiRecommendations) }} pending</span>
                    </div>

                    <div class="space-y-4">
                        @forelse($aiRecommendations as $recommendation)
                            <div class="flex gap-4 p-4 rounded-lg border-l-4 @if($recommendation->priority === 'critical') border-red-500 bg-red-50 @elseif($recommendation->priority === 'high') border-orange-500 bg-orange-50 @else border-blue-500 bg-blue-50 @endif">
                                <div class="flex-shrink-0">
                                    @if($recommendation->priority === 'critical')
                                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $recommendation->title }}</p>
                                    <p class="text-xs text-gray-600 mt-1">{{ Str::limit($recommendation->description, 100) }}</p>
                                    <div class="flex items-center gap-4 mt-2">
                                        @if($recommendation->confidence_score)
                                            <span class="text-xs font-semibold text-gray-900">{{ $recommendation->confidence_score }}% confidence</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-gray-500 text-sm">No AI recommendations at this time.</p>
                                <p class="text-gray-400 text-xs mt-1">The system will analyze data and provide insights automatically.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Donations -->
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Donations</h2>
                        <a href="{{ route('donors.index') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium flex items-center gap-1">
                            View All
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($recentDonations->take(4) as $donation)
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $donation->donor->full_name ?? 'Anonymous' }}</p>
                                    <p class="text-xs text-gray-500">{{ $donation->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-emerald-600">${{ number_format($donation->amount, 0) }}</p>
                                    <p class="text-xs text-gray-500">{{ ucfirst($donation->donation_type) }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 text-sm py-4">No recent donations</p>
                        @endforelse
                    </div>
                </div>

                <!-- Inventory Status -->
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Inventory Status</h2>
                        <a href="{{ route('inventory.index') }}" class="text-xs bg-red-100 text-red-600 px-3 py-1 rounded-full font-medium hover:bg-red-200 transition-colors">
                            23 Low Stock
                        </a>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-900">Medical Supplies</span>
                                <span class="text-sm font-bold text-red-600">12%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: 12%"></div>
                            </div>
                            <p class="text-xs text-orange-600 mt-1 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                Critical - Restock needed
                            </p>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-900">Food Supplies</span>
                                <span class="text-sm font-bold text-orange-600">38%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-orange-500 h-2 rounded-full" style="width: 38%"></div>
                            </div>
                            <p class="text-xs text-orange-600 mt-1 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                Low - Order soon
                            </p>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-900">School Supplies</span>
                                <span class="text-sm font-bold text-emerald-600">87%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full" style="width: 87%"></div>
                            </div>
                            <p class="text-xs text-emerald-600 mt-1 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Good stock
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Welfare Overview -->
            <div class="space-y-6">
                <!-- Welfare Overview -->
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Welfare Overview</h2>

                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Health</span>
                                <span class="text-sm font-bold text-gray-900">94%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-900 h-2 rounded-full" style="width: 94%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Education</span>
                                <span class="text-sm font-bold text-gray-900">98%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-900 h-2 rounded-full" style="width: 98%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Nutrition</span>
                                <span class="text-sm font-bold text-gray-900">91%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-900 h-2 rounded-full" style="width: 91%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Emotional</span>
                                <span class="text-sm font-bold text-gray-900">78%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-900 h-2 rounded-full" style="width: 78%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
