<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl p-1.5 text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Top Cards -->
        <div class="flex justify-evenly">

            <!-- Total Hotels Card -->
            <div class="bg-white shadow rounded-lg p-6 w-[32rem] flex flex-col items-center justify-center">
                <h3 class="text-xl font-medium text-gray-600">Total Hotels</h3>
                <p class="text-5xl font-bold text-gray-800 mt-4">{{ $hotels->count() ?? 0 }}</p>
            </div>

            <!-- Placeholder Cards (you can add more stats here if needed) -->
            <div class="bg-white shadow rounded-lg p-6 w-[32rem] flex flex-col items-center justify-center">
                <h3 class="text-xl font-medium text-gray-600">Total Admin Users</h3>
                <p class="text-5xl font-bold text-gray-800 mt-4">{{$users->count()??0 }}</p>
            </div>


        </div>

        <!-- Recently Added Hotels Table -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Recently Added Hotels</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($hotels as $idx => $hotel)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $idx + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $hotel->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $hotel->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($hotel->created_at)->format('d M, Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No hotels found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
