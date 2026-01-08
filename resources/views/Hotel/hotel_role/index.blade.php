<x-hotel-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            {{-- @can('create role') --}}
            <a href="{{ route('hotel_roles.create') }}"
                class="bg-slate-700 text-sm rounded-md text-white px-4 py-2 hover:bg-slate-800 transition">
                Create Roles
            </a>
            {{-- @endcan --}}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-message></x-message>

                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="w-full text-sm">
                            <thead class="border-b bg-gray-100">
                                <tr class="border-b">
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase"
                                        width="60">
                                        ID
                                    </th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase">
                                        Permissions
                                    </th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase"
                                        width="180">
                                        Created
                                    </th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase"
                                        width="180">
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-100">
                                @if ($roles->isNotEmpty())
                                    @foreach ($roles as $idx => $role)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-3 text-gray-700">
                                                {{ 1 + $idx }}
                                            </td>
                                            <td class="px-6 py-3 font-medium text-gray-800">
                                                {{ $role->display_name }}
                                            </td>
                                            <td class="px-6 py-3 font-medium text-gray-800">
                                                {{ $role->permissions->pluck('name')->implode(', ') }}
                                            </td>
                                            <td class="px-6 py-3 text-gray-700">
                                                {{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y') }}
                                            </td>

                                            <td class="px-6 py-3 text-center space-x-2 flex justify-center">
                                                {{-- @can('edit role') --}}
                                                <a href="{{ route('hotel_roles.edit', $role->id) }}"
                                                    class="bg-gray-900 text-white px-3 py-1.5 rounded-md text-xs hover:bg-gray-700 transition">
                                                    Edit
                                                </a>
                                                {{-- @endcan --}}

                                                {{-- @can('delete role') --}}
                                                <form action="{{ route('hotel_roles.destroy', $role->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-600 text-white px-3 py-1.5 rounded-md text-xs hover:bg-red-700 transition"
                                                        onclick="return confirm('Are you sure you want to delete this customer?')">
                                                        Delete
                                                    </button>
                                                </form>
                                                {{-- @endcan --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center text-gray-500">
                                            No roles found
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </x-app-layout>
