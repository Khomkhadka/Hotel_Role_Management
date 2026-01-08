{{-- <x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Booking
            </h2>
            <a href="{{ route('bookings.index') }}"
               class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">
                Back
            </a>
        </div>
    </x-slot>

    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white w-full max-w-md p-8 rounded-lg shadow-lg">

            <h1 class="text-center text-2xl font-semibold mb-6">
                Booking Form
            </h1>

            <form action="{{ route('bookings.update', $booking->id) }}"
                  method="POST"
                  class="space-y-4">
                @csrf
                @method('PUT')

                <!-- CUSTOMER AUTOCOMPLETE (Free typing allowed) -->
                <div>
                    <label class="block text-sm font-medium mb-1">Customer</label>
                    <select name="customer_id"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $booking->customer_id == $customer->id ? 'selected' : '' }}>
                                {{ $customer->customer_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Booked Date -->
                <div>
                    <label class="block text-sm font-medium mb-1">Booked Date</label>
                    <input type="date" name="booked_date"
                           value="{{ old('booked_date', $booking->booked_date) }}"
                           class="w-full px-3 py-2 border rounded"
                           required>
                </div>

                <!-- CHECK-IN -->
                <div>
                    <label class="block text-sm font-medium mb-1">Check-in Date</label>
                    <input type="date" name="checkin" id="checkin"
                           value="{{ old('checkin', $booking->checkin) }}"
                           class="w-full px-3 py-2 border rounded" required>
                </div>

                <!-- CHECK-OUT -->
                <div>
                    <label class="block text-sm font-medium mb-1">Check-out Date</label>
                    <input type="date" name="checkout" id="checkout"
                           value="{{ old('checkout', $booking->checkout) }}"
                           class="w-full px-3 py-2 border rounded" required>
                </div>

                <!-- HOTEL AUTOCOMPLETE (Existing only) -->
                <div>
                    <label class="block text-sm font-medium mb-1">Hotel</label>
                    <select name="hotel_id"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">
                        <option value="">Select Hotel</option>
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}" {{ $booking->hotel_id == $hotel->id ? 'selected' : '' }}>
                                {{ $hotel->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- PACKAGE AUTOCOMPLETE (Existing only) -->
                <div>
                    <label class="block text-sm font-medium mb-1">Package</label>
                    <select name="package_id"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">
                        <option value="">Select Package</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" {{ $booking->package_id == $package->id ? 'selected' : '' }}>
                                {{ $package->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- NOTE -->
                <div>
                    <label class="block text-sm font-medium mb-1">Note</label>
                    <textarea name="note"
                              class="w-full px-3 py-2 border rounded"
                              required>{{ old('note', $booking->note) }}</textarea>
                </div>

                <button type="submit"
                        class="w-full bg-black text-white py-2 rounded font-semibold hover:bg-gray-800">
                    Update Booking
                </button>
            </form>

            @if ($errors->any())
                <div class="bg-black text-white p-4 rounded-md mt-6">
                    <ul class="list-inside list-disc text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</x-app-layout> --}}
