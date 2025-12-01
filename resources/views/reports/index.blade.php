<x-app-layout>
    <!-- Header Section -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Reports & Analytics</h1>
            <p class="text-gray-600 text-sm mt-1">Comprehensive insights and operational metrics</p>
        </div>
        <div class="flex items-center gap-3">
            <select id="periodSelector" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 transition-colors" onchange="changePeriod(this.value)">
                <option value="week" {{ $period == 'week' ? 'selected' : '' }}>Last Week</option>
                <option value="1" {{ $period == 1 ? 'selected' : '' }}>Last Month</option>
                <option value="3" {{ $period == 3 ? 'selected' : '' }}>Last 3 Months</option>
            </select>
            <button onclick="exportReport()" class="flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-400 to-blue-500 hover:from-emerald-500 hover:to-blue-600 text-white font-semibold rounded-lg transition-all shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export Report
            </button>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Revenue -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-1">Total Revenue</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">${{ number_format($stats['total_revenue']) }}</p>
                <div class="flex items-center gap-1 text-sm">
                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    <span class="text-emerald-600 font-semibold">+{{ $stats['revenue_change'] }}% from last period</span>
                </div>
            </div>

            <!-- Total Expenses -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-1">Total Expenses</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">${{ number_format($stats['total_expenses']) }}</p>
                <div class="flex items-center gap-1 text-sm">
                    <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    <span class="text-orange-600 font-semibold">+{{ $stats['expenses_change'] }}% from last period</span>
                </div>
            </div>

            <!-- Active Donors -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-1">Active Donors</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['active_donors'] }}</p>
                <div class="flex items-center gap-1 text-sm">
                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    <span class="text-emerald-600 font-semibold">+{{ $stats['new_donors'] }} new donors</span>
                </div>
            </div>

            <!-- Inventory Value -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-1">Inventory Value</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">${{ number_format($stats['inventory_value']) }}</p>
                <p class="text-sm text-gray-600">Well stocked</p>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Donation Trends -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Donation Trends</h2>
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full">+18% this month</span>
                </div>
                <div class="h-80">
                    <canvas id="donationTrendsChart"></canvas>
                </div>
            </div>

            <!-- Expense Breakdown -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Expense Breakdown</h2>
                    <button class="flex items-center gap-1 text-sm text-gray-600 hover:text-gray-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        This Month
                    </button>
                </div>
                <div class="h-80">
                    <canvas id="expenseBreakdownChart"></canvas>
                </div>
            </div>
        </div>

        <!-- More Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Children Welfare Trends -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Children Welfare Trends</h2>
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Overall improving</span>
                </div>
                <div class="h-80">
                    <canvas id="welfareTrendsChart"></canvas>
                </div>
            </div>

            <!-- Inventory Distribution -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Inventory Distribution</h2>
                    <span class="text-sm text-gray-600">By Category</span>
                </div>
                <div class="h-80 flex items-center justify-center">
                    <canvas id="inventoryDistributionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- AI-Powered Operational Insights -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">AI-Powered Operational Insights</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($aiInsights as $insight)
                    <div class="p-5 border border-gray-200 rounded-lg hover:border-emerald-300 transition-colors">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="font-semibold text-gray-900">{{ $insight['title'] }}</h3>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                @if($insight['type'] === 'positive') bg-emerald-100 text-emerald-700
                                @elseif($insight['type'] === 'savings') bg-blue-100 text-blue-700
                                @elseif($insight['type'] === 'efficiency') bg-purple-100 text-purple-700
                                @else bg-gray-100 text-gray-700
                                @endif">
                                {{ $insight['badge'] }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600">{{ $insight['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Donation Trends Chart
        const donationCtx = document.getElementById('donationTrendsChart');
        new Chart(donationCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($donationTrends, 'month')) !!},
                datasets: [{
                    label: 'Donation Amount ($)',
                    data: {!! json_encode(array_column($donationTrends, 'amount')) !!},
                    borderColor: 'rgb(16, 185, 129)',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y'
                }, {
                    label: 'Number of Donors',
                    data: {!! json_encode(array_column($donationTrends, 'donors')) !!},
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        beginAtZero: true
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        beginAtZero: true,
                        grid: {
                            drawOnChartArea: false,
                        }
                    }
                }
            }
        });

        // Expense Breakdown Chart
        const expenseCtx = document.getElementById('expenseBreakdownChart');
        new Chart(expenseCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($expenseBreakdown->keys()->toArray()) !!},
                datasets: [{
                    label: 'Expenses ($)',
                    data: {!! json_encode($expenseBreakdown->values()->toArray()) !!},
                    backgroundColor: 'rgb(16, 185, 129)',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Welfare Trends Chart
        const welfareCtx = document.getElementById('welfareTrendsChart');
        new Chart(welfareCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($welfareTrends, 'month')) !!},
                datasets: [{
                    label: 'Education',
                    data: {!! json_encode(array_column($welfareTrends, 'education')) !!},
                    borderColor: 'rgb(59, 130, 246)',
                    tension: 0.4
                }, {
                    label: 'Emotional',
                    data: {!! json_encode(array_column($welfareTrends, 'emotional')) !!},
                    borderColor: 'rgb(139, 92, 246)',
                    tension: 0.4
                }, {
                    label: 'Health',
                    data: {!! json_encode(array_column($welfareTrends, 'health')) !!},
                    borderColor: 'rgb(16, 185, 129)',
                    tension: 0.4
                }, {
                    label: 'Nutrition',
                    data: {!! json_encode(array_column($welfareTrends, 'nutrition')) !!},
                    borderColor: 'rgb(245, 158, 11)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        min: 60,
                        max: 100
                    }
                }
            }
        });

        // Inventory Distribution Chart
        const inventoryCtx = document.getElementById('inventoryDistributionChart');
        new Chart(inventoryCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($inventoryDistribution->keys()->toArray()) !!},
                datasets: [{
                    data: {!! json_encode($inventoryDistribution->pluck('percentage')->toArray()) !!},
                    backgroundColor: [
                        'rgb(16, 185, 129)',  // Food - Green
                        'rgb(239, 68, 68)',   // Medical - Red
                        'rgb(59, 130, 246)',  // Clothing - Blue
                        'rgb(245, 158, 11)',  // Hygiene - Orange
                        'rgb(139, 92, 246)',  // School - Purple
                        'rgb(107, 114, 128)'  // Other - Gray
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + '%';
                            }
                        }
                    }
                }
            }
        });

        // Period selector function
        function changePeriod(period) {
            window.location.href = '{{ route("reports.index") }}?period=' + period;
        }

        // Export report function
        function exportReport() {
            const period = document.getElementById('periodSelector').value;

            // Redirect to download the CSV export
            window.location.href = '{{ route("reports.index") }}?period=' + period + '&export=csv';
        }
    </script>
</x-app-layout>
