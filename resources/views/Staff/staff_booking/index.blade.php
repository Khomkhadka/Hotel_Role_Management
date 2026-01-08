<x-staff-layout>
    <x-slot name="header">
           <div class="flex justify-between">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Booking
        </h2>
     @can('create-booking')
    <a href="{{ route('staff_bookings.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Create Booking</a>
     @endcan
       </div>
    </x-slot>

    <div class="m-5">
    @if($bookings->isEmpty())
        <p class="text-center text-gray-500 py-10 text-sm">No bookings found.</p>
    @else
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Booked Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Check-in</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Check-out</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Note</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Hotel</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Package</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($bookings as $booking)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-gray-700">{{ $booking->booked_date }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $booking->checkin }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $booking->checkout }}</td>
                            <td class="px-4 py-3 text-gray-700">
                                {{ $booking->note ?? 'N/A' }}
                            </td>

                            <td class="px-4 py-3 text-gray-700">
                                @if($booking->hotels)
                                    {{ $booking->hotels->name }}
                                @else
                                    <span class="text-gray-400 italic">N/A</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-gray-700">
                                @if($booking->customers)
                                    {{ $booking->customers->customer_name }}
                                @else
                                    <span class="text-gray-400 italic">N/A</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-gray-700">
                                @if($booking->packages)
                                    {{ $booking->packages->name }}
                                @else
                                    <span class="text-gray-400 italic">N/A</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 space-x-2 flex">
                               @can('edit-booking')
                                    <a href="{{ route('staff_bookings.edit', $booking->id) }}"
                                   class="bg-gray-900 text-white px-3 py-1.5 rounded-md text-xs hover:bg-gray-700 transition">
                                    Edit
                                </a>
                               @endcan
    
                                <form action="{{ route('staff_bookings.destroy', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @can('delete-booking')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1.5 rounded-md text-xs hover:bg-red-700 transition"
                                            onclick="return confirm('Are you sure you want to delete this booking?')">
                                        Delete
                                    </button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Pagination Links -->
        <tr class="m-2">
            <td colspan="3" class="px-4 py-4 text-sm">
                {{ $bookings->links() }}
            </td>
        </tr>

 </div>

</x-staff-layout>
