<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Daily Log Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- Button Go Back to Index --}}
            <div class="flex justify-start mb-4">
                <a href="{{ route('manage-daily-log.index') }}" class="inline-block px-4 py-2 text-xs font-semibold tracking-widest text-left text-white uppercase bg-indigo-500 rounded-md">
                    Go Back
                </a>
            </div>

            {{-- Form --}}
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-md">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-8">
                        {{-- Name Employee --}}
                        <div>
                            <x-input-label :value="__('Name Employee')" />
                            <x-text-input disabled class="block w-full mt-1 text-sm" type="text" :value="old('name', $dailyLog->user->name)" />
                        </div>

                        {{-- Position Employee --}}
                        <div>
                            <x-input-label :value="__('Position Employee')" />
                            <x-text-input disabled class="block w-full mt-1 text-sm" type="text" :value="old('position', $dailyLog->user->detail_user->position->name)" />
                        </div>

                        {{-- Description Log Input --}}
                        <div>
                            <x-input-label :value="__('Log Description')" />
                            <textarea disabled class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" rows="4">{{ $dailyLog->description }}</textarea>
                        </div>

                        {{-- File Upload --}}
                        <div>
                            <x-input-label :value="__('Proof Of Employment')" />
                            <a href="{{ asset('storage/' . $item->proof_of_employment) }}" class="hover:underline hover:text-indigo-500">File Proof</a>
                        </div>

                        {{-- Status Daily Log --}}
                        <div>
                            <x-input-label :value="__('Status Log')" />
                            <x-text-input disabled class="block w-full mt-1 text-sm" type="text" :value="old('status', $dailyLog->status)" />
                        </div>

                        {{-- Created at Daily Log --}}
                        <div>
                            <x-input-label :value="__('Date')" />
                            <x-text-input disabled class="block w-full mt-1 text-sm" type="text" :value="old('created at', $dailyLog->created_at->format('Y-m-d'))" />
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>