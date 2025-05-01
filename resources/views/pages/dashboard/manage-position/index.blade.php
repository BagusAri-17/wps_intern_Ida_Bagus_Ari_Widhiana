<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Position') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Button Add --}}
            <div class="flex justify-end mb-4">
                <a href="{{ route('manage-position.create') }}" class="inline-block px-4 py-2 text-left bg-indigo-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                    + Add Position
                </a>
            </div>

            {{-- Table --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-md">
                <div class="relative overflow-x-auto">
                    @if ($positions->isEmpty())
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            Data not found
                        </div>
                    @else
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name Position
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Level
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created By
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($positions as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                        <td class="px-6 py-4">
                                            {{ $item->id }}.
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($item->level === 1)
                                                Director
                                            @elseif ($item->level === 2)
                                                Manager
                                            @elseif ($item->level === 3)
                                                Staff
                                            @else
                                                Not Found
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->created_at->setTimezone('Asia/Makassar')->locale('en')->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-4 flex items-center gap-2">
                                            <a href="{{ route('manage-position.edit', $item->id) }}" class="inline-block px-4 py-2 text-left bg-blue-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                                                Edit
                                            </a>
                                            <form action="{{ route('manage-position.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- empty --}}
                                @endforelse
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>