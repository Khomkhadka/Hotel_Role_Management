{{-- <x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Package
            </h2>
            <a href="{{ route('packages.index') }}"
               class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">
                Back
            </a>
        </div>
    </x-slot>

    <div class="bg-gray-100 flex items-center justify-center min-h-screen">

        <div class="bg-white w-full max-w-md p-8 rounded-lg shadow-lg">
            <h1 class="text-center text-2xl font-semibold mb-6 tracking-wide">
                Edit Package
            </h1>

            <form action="{{ route('packages.update', $package->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Package Name -->
                <div>
                    <label class="block text-sm font-medium mb-1">Package Name</label>
                    <input type="text" name="name"
                           value="{{ old('name', $package->name) }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">{{ old('description', $package->description) }}</textarea>
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-sm font-medium mb-1">Price</label>
                    <input type="number" name="price" step="0.01"
                           value="{{ old('price', $package->price) }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                            required>
                        <option value="active" {{ old('status', $package->status) == 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="inactive" {{ old('status', $package->status) == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

                <!-- Hotel -->
                <div>
                    <label class="block text-sm font-medium mb-1">Hotel</label>
                    <select name="hotel_id"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">
                        <option value="">Select Hotel</option>
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}"
                                {{ old('hotel_id', $package->hotel_id) == $hotel->id ? 'selected' : '' }}>
                                {{ $hotel->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full bg-black text-white py-2 rounded font-semibold hover:bg-gray-800 transition">
                    Update Package
                </button>
            </form>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mt-6 bg-red-100 text-red-700 p-4 rounded">
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>

    </div>
</x-app-layout> --}}
