<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permissions') }}
            </h2>

            @can('create permission')
                <a href="{{ route('permissions.create') }}"
                   class="bg-slate-700 text-sm rounded-md text-white px-4 py-2 hover:bg-slate-800 transition">
                    Create Permissions
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <x-message></x-message>

                    {{-- Tabs --}}
                    <div class="border-b border-gray-200 mb-6">
                        <nav class="flex space-x-8">
                            <a href="{{ route('permissions.index', ['tab' => 'hotel']) }}"
                               class="pb-2 text-sm font-semibold
                               {{ $tab === 'hotel'
                                    ? 'border-b-2 border-slate-700 text-slate-700'
                                    : 'text-gray-500 hover:text-gray-700' }}">
                                Hotel Permissions
                            </a>

                            <a href="{{ route('permissions.index', ['tab' => 'admin']) }}"
                               class="pb-2 text-sm font-semibold
                               {{ $tab === 'admin'
                                    ? 'border-b-2 border-slate-700 text-slate-700'
                                    : 'text-gray-500 hover:text-gray-700' }}">
                                Admin Permissions
                            </a>
                        </nav>
                    </div>

                    {{-- Permissions Table --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="w-full text-sm">
                            <thead class="border-b bg-gray-100">
                                <tr class="border-b">
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase" width="60">ID</th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase">Name</th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase" width="180">Created</th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase" width="180">Action</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-100">
                                @if ($permissions->isNotEmpty())
                                    @foreach ($permissions as $idx => $permission)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-3 text-gray-700">{{ $permissions->firstItem() + $idx }}</td>
                                            <td class="px-6 py-3 font-medium text-gray-800">{{ $permission->display_name }}</td>
                                            <td class="px-6 py-3 text-gray-700">{{ $permission->created_at->format('d M, Y') }}</td>
                                            <td class="px-6 py-3 flex justify-center space-x-2">
                                                @can('edit permission')
                                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                                       class="bg-gray-900 text-white px-3 py-1.5 rounded-md text-xs hover:bg-gray-700 transition">
                                                        Edit
                                                    </a>
                                                @endcan

                                                @can('delete permission')
                                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="bg-red-600 text-white px-3 py-1.5 rounded-md text-xs hover:bg-red-700 transition"
                                                                onclick="return confirm('Are you sure you want to delete this permission?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="px-6 py-3 text-center text-gray-500">
                                            No permissions found.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="px-4 py-4">
                            {{ $permissions->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
