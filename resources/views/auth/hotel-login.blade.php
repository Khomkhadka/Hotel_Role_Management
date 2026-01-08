<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hotel Login
        </h2>
    </x-slot>

    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white w-full max-w-md p-8 rounded-lg shadow-lg">

            <h1 class="text-center text-2xl font-semibold mb-6 tracking-wide">
                Login to Hotel Panel
            </h1>

            <form action="{{ route('hotel.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email"
                           value="{{ old('email') }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>

                <!-- Hotel Owner -->
                <div>
                    <label class="block text-sm font-medium mb-1">Hotel Owner</label>
                    <input type="text" name="hotelowner"
                           value="{{ old('hotelowner') }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full bg-black text-white py-2 rounded font-semibold hover:bg-gray-800 transition">
                    Login
                </button>
            </form>

            <!-- Errors -->
            @if ($errors->any())
                <div class="mt-6 bg-black text-white p-4 rounded">
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
