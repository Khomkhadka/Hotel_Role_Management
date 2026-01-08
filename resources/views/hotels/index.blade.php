<x-app-layout>
    <x-slot name="header">
         <div class="flex justify-between items-center">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Hotels') }}
        </h2>
        @can('create hotel')
        <a href="{{ route('hotels.create') }}"
           class="bg-slate-700 text-sm rounded-md text-white px-4 py-2 hover:bg-slate-800 transition">
            Create Hotels
        </a>
        @endcan
       </div>
    </x-slot>

    <div class="m-5">

        @if(empty($hotels))
            <p class="text-center text-gray-500 py-10 text-sm">No hotels found.</p>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            {{-- <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Owner</th> --}}
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Address</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($hotels as $hotel)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $hotel->name }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $hotel->email }}</td>
                                {{-- <td class="px-4 py-3 text-gray-700">{{ $hotel->admins->name??''}}</td> --}}
                                <td class="px-4 py-3 text-gray-700">{{ $hotel->type }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $hotel->address }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $hotel->contact }}</td>
                                <td class="px-4 py-3 capitalize">
                                    <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs font-medium">
                                        {{ $hotel->status }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 space-x-2 flex">
                                    @can('edit customer')
                                    <a href="{{ route('hotels.edit', $hotel->id) }}"
                                       class="bg-gray-900 text-white px-3 py-1.5 rounded-md text-xs hover:bg-gray-700 transition">
                                        Edit
                                    </a>
                                    @endcan

                                    @can('delete customer')
                                    <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1.5 rounded-md text-xs hover:bg-red-700 transition"
                                                onclick="return confirm('Are you sure you want to delete this hotel?')">
                                            Delete
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</x-app-layout>
