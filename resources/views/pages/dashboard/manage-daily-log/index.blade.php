<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Daily Log') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Button Add --}}
            <div class="flex justify-end mb-4">
                <a href="{{ route('manage-daily-log.create') }}" class="inline-block px-4 py-2 text-left bg-indigo-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                    + Add Log
                </a>
            </div>

        </div>
    </div>
</x-app-layout>