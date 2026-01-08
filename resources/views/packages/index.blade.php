{{-- <x-app-layout>
    <x-slot name="header">
          <div class="flex justify-between items-center">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Packages') }}
        </h2>
        @can('create package')
        <a href="{{ route('packages.create') }}"
           class="bg-slate-700 text-sm rounded-md text-white px-4 py-2 hover:bg-slate-800 transition">
            Create Packages
        </a>
        @endcan
       </div>
    </x-slot>

    <div class="m-5">
        @if (empty($packages))
            <p class="text-center text-gray-500 py-10 text-sm">No packages found.</p>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Package Name
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Description
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Price
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Hotel
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($packages as $package)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $package->name }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $package->description }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    ${{ number_format($package->price, 2) }}
                                </td>
                                <td class="px-4 py-3 capitalize">
                                    <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs font-medium">
                                        {{ $package->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    @if ($package->hotels)
                                        {{ $package->hotels->name }}
                                    @else
                                        <span class="text-gray-400 italic">N/A</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 space-x-2 flex">
                                    @can('edit package')
                                    <a href="{{ route('packages.edit', $package->id) }}"
                                       class="bg-gray-900 text-white px-3 py-1.5 rounded-md text-xs hover:bg-gray-700 transition">
                                        Edit
                                    </a>
                                    @endcan
                                    @can('delete package')
                                    <form action="{{ route('packages.destroy', $package->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1.5 rounded-md text-xs hover:bg-red-700 transition"
                                                onclick="return confirm('Are you sure you want to delete this package?')">
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

        <!-- Pagination Links -->
        <tr>
            <td colspan="3" class="px-4 py-4 text-sm">
                {{ $packages->links() }}
            </td>
        </tr>
    </div>
</x-app-layout> --}}
