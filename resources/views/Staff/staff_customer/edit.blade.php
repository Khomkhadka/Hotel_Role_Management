<x-staff-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Customers
            </h2>
            <a href="{{ route('staff_customers.index') }}"
                class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Back</a>
        </div>
    </x-slot>
    <div class="bg-gray-100 min-h-screen m-0">

        <div class="bg-white w-full p-8 rounded-lg shadow-lg">

            <h1 class="text-2xl font-semibold text-center mb-6">Customer Form</h1>

            <form action="{{ route('staff_customers.update', $customers->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">Customer
                        Name</label>
                    <input type="text" name="customer_name" id="customer_name"
                        value="{{ old('customer_name', $customers->customer_name ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email"
                        value="{{ old('email', $customers->email ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                </div>

                <div class="mb-4">
                    <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-2">Customer
                        Address</label>
                    <input type="text" name="customer_address" id="customer_address"
                        value="{{ old('customer_address', $customers->customer_address ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                </div>

                <div class="mb-4">
                    <label for="contact" class="block text-sm font-medium text-gray-700 mb-2">Contact</label>
                    <input type="text" name="contact" id="contact"
                        value="{{ old('contact', $customers->contact ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                </div>

                <div class="mb-4">
                    <label for="dob" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="dob" id="dob" value="{{ old('dob', $customers->dob ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                </div>

                <!-- Hidden input (submitted to backend) -->
                <input type="hidden" name="hotel_id" value="{{ old('hotel_id', $customers->hotel_id ?? '') }}">

                <!-- Readonly input (shown to user) -->
                  <input type="hidden" name="hotel_id" value="{{ $hotelId }}">
                </div>
                {{-- <div class="mb-4">
                <label for="hotel_id" class="block text-sm font-medium text-gray-700 mb-2">Hotel ID</label>
                <input type="number" name="hotel_id" id="hotel_id" 
                    value="{{ old('hotel_id', $customers->hotel_id ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-black">
            </div> --}}

                <button type="submit"
                    class="w-full py-3 bg-black text-white rounded-md font-semibold hover:bg-gray-800">Update</button>
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
</x-staff-layout>
