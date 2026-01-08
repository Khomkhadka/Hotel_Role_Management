<x-hotel-layout>
    <x-slot name="header">
                   <div class="flex justify-between">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Customers
        </h2>
        
    <a href="{{ route('hotel_customers.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Create Customers</a>
       </div>
       
    </x-slot>


 

        @if(empty($customers))
            <p class="text-center text-gray-500 py-10 text-sm">No customers found.</p>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Address</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Contact</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">DOB</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Hotel Name</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($customers as $customer)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $customer->customer_name }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $customer->email }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $customer->customer_address }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $customer->contact }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $customer->dob }}</td>
                                <td class="px-4 py-3 text-gray-700">
                                    @if ($customer->hotels)
                                        {{ $customer->hotels->name }}
                                    @else
                                        <span class="text-gray-400 italic">N/A</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 space-x-2 flex">
                                   
                                    <a href="{{ route('hotel_customers.edit', $customer->id) }}"
                                       class="bg-gray-900 text-white px-3 py-1.5 rounded-md text-xs hover:bg-gray-700 transition">
                                        Edit
                                    </a>
                                   

                                    
                                    <form action="{{ route('hotel_customers.destroy',$customer->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1.5 rounded-md text-xs hover:bg-red-700 transition"
                                                onclick="return confirm('Are you sure you want to delete this customer?')">
                                            Delete
                                        </button>
                                    </form>
                                   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Pagination (same position) -->
        <tr>
            <td colspan="3" class="px-4 py-4">
                {{ $customers->links() }}
            </td>
        </tr>

  
</x-hotel-layout>
