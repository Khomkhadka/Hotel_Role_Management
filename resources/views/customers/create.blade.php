{{-- <x-app-layout>
    <x-slot name="header">
         <div class="flex justify-between">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Customers
        </h2>
        <a href="{{ route('customers.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Back</a>
       </div>
    </x-slot>
<div class="m-4">
    <div class="bg-gray-100 flex justify-center items-center min-h-screen p-4">

<div class="bg-white w-full max-w-md p-8 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Customer Form</h1>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="bg-red-600 text-white p-4 rounded mb-6">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customers.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Customer Name</label>
            <input type="text" name="customer_name" id="customer_name" required
                   value="{{ old('customer_name') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" required
                   value="{{ old('email') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div>
            <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-1">Customer Address</label>
            <input type="text" name="customer_address" id="customer_address" required
                   value="{{ old('customer_address') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div>
            <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact</label>
            <input type="text" name="contact" id="contact" required
                   value="{{ old('contact') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div>
            <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
            <input type="date" name="dob" id="dob" required
                   value="{{ old('dob') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        {{-- <div>
            <label for="hotel_id" class="block text-sm font-medium text-gray-700 mb-1">Hotel ID</label>
            <input type="number" name="hotel_id" id="hotel_id" required
                   value="{{ old('hotel_id') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
        </div> 

              <div>
            <label class="block text-sm font-medium mb-1">Hotel</label>
            <select name="hotel_id"
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">
                <option value="">Select Hotel</option>
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit"
                class="w-full bg-black text-white py-2 rounded-md font-semibold hover:bg-gray-800 transition">
            Create Customer
        </button>
    </form>
</div>
</div>
</div>
</x-app-layout>
 --}}
