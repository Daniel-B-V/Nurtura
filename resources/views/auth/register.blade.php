<x-guest-layout>
    <!-- Tab Navigation -->
    <div class="flex gap-2 mb-6">
        <a href="{{ route('login') }}" class="flex-1 py-2.5 text-center text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg border-2 border-transparent transition-colors">
            Login
        </a>
        <a href="{{ route('register') }}" class="flex-1 py-2.5 text-center text-sm font-medium text-emerald-600 bg-gray-50 rounded-lg border-2 border-transparent">
            Sign Up
        </a>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Full Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-900 mb-2">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="w-full px-4 py-3 bg-gray-50 border-0 rounded-lg text-sm text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-colors"
                   placeholder="Enter your full name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="w-full px-4 py-3 bg-gray-50 border-0 rounded-lg text-sm text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-colors"
                   placeholder="Enter your email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-900 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full px-4 py-3 bg-gray-50 border-0 rounded-lg text-sm text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-colors"
                   placeholder="Enter your password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mb-6">
            <label for="role" class="block text-sm font-medium text-gray-900 mb-2">Role</label>
            <select id="role" name="role" required
                    class="w-full px-4 py-3 bg-gray-50 border-0 rounded-lg text-sm text-gray-900 focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-colors">
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Create Account Button -->
        <button type="submit" class="w-full py-3.5 text-white font-semibold rounded-lg bg-gradient-to-r from-emerald-400 to-blue-500 hover:from-emerald-500 hover:to-blue-600 focus:ring-4 focus:ring-emerald-200 transition-all shadow-md">
            Create Account
        </button>

        <!-- AI Platform Note -->
        <div class="mt-6 flex items-start gap-3 p-4 bg-blue-50 rounded-lg">
            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/>
            </svg>
            <p class="text-xs text-gray-600 leading-relaxed">AI-powered platform for compassionate care management</p>
        </div>
    </form>
</x-guest-layout>
