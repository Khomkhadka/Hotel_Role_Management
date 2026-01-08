<x-staff-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Booking
            </h2>
            <a href="{{ route('staff_bookings.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">
                Back
            </a>
        </div>
    </x-slot>

    <div class="bg-gray-100 min-h-screen ">
        <div class="bg-white w-full p-8 rounded-lg shadow-lg">

            <h1 class="text-center text-2xl font-semibold mb-6">
                Booking Form
            </h1>

            <form action="{{ route('staff_bookings.store') }}" method="POST" class="space-y-4"
                onsubmit="return validateForm()">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- CUSTOMER AUTOCOMPLETE (Free typing allowed) -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Customer</label>
                        <select name="customer_id"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">
                            <option value="">Select Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->customer_name }}
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
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}"
                                {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                {{ $package->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Booked Date -->
                <div>
                    <label class="block text-sm font-medium mb-1">Booked Date</label>
                    <input type="date" name="booked_date" class="w-full px-3 py-2 border rounded" required>
                </div>

                <!-- CHECK-IN -->
                <div>
                    <label class="block text-sm font-medium mb-1">Check-in Date</label>
                    <input type="date" name="checkin" id="checkin" class="w-full px-3 py-2 border rounded"
                        required>
                </div>

                <!-- CHECK-OUT -->
                <div>
                    <label class="block text-sm font-medium mb-1">Check-out Date</label>
                    <input type="date" name="checkout" id="checkout" class="w-full px-3 py-2 border rounded"
                        required>
                </div>

                <!-- HOTEL AUTOCOMPLETE (Existing only) -->

                <input type="hidden" name="hotel_id" value="{{ $hotelId }}">
                </div>

                {{-- <div>
            <label class="block text-sm font-medium mb-1">Hotel</label>
            <select name="hotel_id"
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">
                <option value="">Select Hotel</option>
                @foreach ($hotels as $hotel)
                    <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->name }}
                    </option>
                @endforeach
            </select>
        </div> --}}

                <!-- text area -->
                <div>
                    <label class="block text-sm font-medium mb-1">Note</label>
                    <textarea type="text" name="note" class="w-full px-3 py-2 border rounded" required>somenote must be put
                    </textarea>
                </div>

                <button type="submit" class="w-full bg-black text-white py-2 rounded font-semibold hover:bg-gray-800">
                    Create Booking
                </button>
            </form>

        </div>
    </div>
</x-staff-layout>
