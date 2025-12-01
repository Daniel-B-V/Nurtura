<x-app-layout>
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('volunteers.index') }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Add New Volunteer</h1>
                <p class="text-gray-600 text-sm mt-1">Register a new volunteer in the system</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('volunteers.store') }}" method="POST" class="max-w-4xl">
        @csrf

        <div class="bg-white rounded-xl shadow-sm p-8 space-y-8">
            <!-- Personal Information -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                        <input type="text" name="name" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                        <input type="email" name="email" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number *</label>
                        <input type="text" name="phone" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                        <textarea name="address" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"></textarea>
                    </div>
                </div>
            </div>

            <!-- Volunteer Details -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Volunteer Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Join Date -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Join Date *</label>
                        <input type="date" name="join_date" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                        <select name="status" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Skills -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Skills</label>
                        <input type="text" name="skills" placeholder="e.g., Teaching, Cooking, Healthcare" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <!-- Areas of Interest -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Areas of Interest</label>
                        <input type="text" name="areas_of_interest" placeholder="e.g., Education, Childcare" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <!-- Availability -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Availability</label>
                        <input type="text" name="availability" placeholder="e.g., Weekends, Weekdays 9am-5pm" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Emergency Contact</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Emergency Contact Name -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Emergency Contact Name</label>
                        <input type="text" name="emergency_contact_name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <!-- Emergency Contact Phone -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Emergency Contact Phone</label>
                        <input type="text" name="emergency_contact_phone" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Additional Notes</h2>
                <textarea name="notes" rows="4" placeholder="Any additional information about the volunteer..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"></textarea>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('volunteers.index') }}" class="px-6 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-400 to-purple-500 hover:from-blue-500 hover:to-purple-600 text-white font-semibold rounded-lg transition-all shadow-md hover:shadow-lg">
                    Add Volunteer
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
