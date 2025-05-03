<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Daily Log') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Button Add --}}
            @if ($level === 2 || $level === 3)
                <div class="flex justify-end mb-4">
                    <a href="{{ route('manage-daily-log.create') }}" class="inline-block px-4 py-2 text-left bg-indigo-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                        + Add Log
                    </a>
                </div>
            @endif
            
            {{-- Table My Logs --}}
            @if ($level === 2 || $level === 3)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-md mb-4">
                    <div class="p-4 text-center">
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('My Logs') }}
                        </h3>
                    </div>
                    <div class="relative overflow-x-auto">
                        @if ($myLogs->isEmpty())
                            <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
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
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Proof
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($myLogs as $item)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                            <td class="px-6 py-4">
                                                {{ $loop->index+1 }}.
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $item->created_at->setTimezone('Asia/Makassar')->toDateString() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $item->description }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($item->status == 'accept')
                                                    <span class="text-green-500">Accept</span>
                                                @elseif($item->status == 'reject')
                                                    <span class="text-red-500">Reject</span>
                                                @elseif($item->status == 'pending')
                                                    <span class="text-yellow-500">Pending</span>
                                                @else
                                                    {{ $item->status }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($item->proof_of_employment)
                                                    <a href="storage/{{ $item->proof_of_employment }}" target="_blank" class="hover:underline hover:text-indigo-500">File Proof</a>
                                                @else
                                                    -
                                                @endif
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
            @endif

            {{-- Table to Verified Logs --}}
            @if ($level === 1 || $level === 2)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-md mb-4">
                    <div class="p-4 text-center">
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('Logs to Verified') }}
                        </h3>
                    </div>
                    <div class="relative overflow-x-auto">
                        @if ($logsToVerify->isEmpty())
                            <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
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
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Position
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Proof
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($logsToVerify as $item)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                            <td class="px-6 py-4">
                                                {{ $loop->index+1 }}.
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $item->created_at->setTimezone('Asia/Makassar')->toDateString() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $item->user->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $item->user->detail_user->position->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $item->description }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($item->status == 'accept')
                                                    <span class="text-green-500">Accept</span>
                                                @elseif($item->status == 'reject')
                                                    <span class="text-red-500">Reject</span>
                                                @elseif($item->status == 'pending')
                                                    <span class="text-yellow-500">Pending</span>
                                                @else
                                                    {{ $item->status }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($item->proof_of_employment)
                                                    <a href="storage/{{ $item->proof_of_employment }}" target="_blank" class="hover:underline hover:text-indigo-500">File Proof</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 flex items-center gap-2">
                                                <a href={{ route('reject.status', $item->id) }} class="inline-block px-4 py-2 text-left bg-red-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                                                    Reject
                                                </a>
                                                <a href={{ route('accept.status', $item->id) }} class="inline-block px-4 py-2 text-left bg-green-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                                                    Accept
                                                </a>
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
            @endif

            {{-- Table List Logs --}}
            @if ($level === 1 || $level === 2)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-md mb-4">
                    <div class="p-4 text-center">
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('List Logs') }}
                        </h3>
                    </div>
                    <div class="relative overflow-x-auto">
                        @if ($listLogs->isEmpty())
                            <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
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
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Position
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Proof
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($listLogs as $item)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                            <td class="px-6 py-4">
                                                {{ $loop->index+1 }}.
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $item->created_at->setTimezone('Asia/Makassar')->toDateString() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $item->user->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $item->user->detail_user->position->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $item->description }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($item->status == 'accept')
                                                    <span class="text-green-500">Accept</span>
                                                @elseif($item->status == 'reject')
                                                    <span class="text-red-500">Reject</span>
                                                @elseif($item->status == 'pending')
                                                    <span class="text-yellow-500">Pending</span>
                                                @else
                                                    {{ $item->status }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($item->proof_of_employment)
                                                    <a href="storage/{{ $item->proof_of_employment }}" target="_blank" class="hover:underline hover:text-indigo-500">File Proof</a>
                                                @else
                                                    -
                                                @endif
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
            @endif
        </div>
    </div>
</x-app-layout>