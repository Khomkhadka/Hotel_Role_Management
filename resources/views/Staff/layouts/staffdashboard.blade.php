<x-staff-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Top Cards -->
        <div class="flex justify-evenly">

            <!-- Total Hotels Card -->
            <div class="bg-white shadow rounded-lg p-6 w-[22rem] flex flex-col items-center justify-center">
                <h3 class="text-xl font-medium text-gray-600">Total Customers</h3>
                <p class="text-5xl font-bold text-gray-800 mt-4">{{ $customers->count() ?? 0 }}</p>
            </div>

            <!-- Placeholder Cards (you can add more stats here if needed) -->
            <div class="bg-white shadow rounded-lg p-6 w-[22rem] flex flex-col items-center justify-center">
                <h3 class="text-xl font-medium text-gray-600">Total Bookings</h3>
                <p class="text-5xl font-bold text-gray-800 mt-4">{{$bookings->count()??0 }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6 w-[22rem] flex flex-col items-center justify-center">
                <h3 class="text-xl font-medium text-gray-600">Total Staffs</h3>
                <p class="text-5xl font-bold text-gray-800 mt-4">{{$staffs->count()??0 }}</p>
            </div>


        </div>

        <!-- Recently Added Hotels Table -->
        @can('view-customers')
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Recent Customers</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Customer Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Address</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($customers as $idx => $customer)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $idx + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $customer->customer_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $customer->email}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $customer->customer_address}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $customer->email}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No customers found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>           
        @endcan

    </div>
</x-staff-layout>
