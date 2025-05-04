<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Daily Log') }}
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
                    <form method="POST" action="{{ route('manage-daily-log.update', $dailyLog->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-8">
                            {{-- Description Log Input --}}
                            <div>
                                <x-input-label for="description" :value="__('Log Description')" />
                                <textarea id="description" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" name="description" :value="old('name')" placeholder="Input description log here..." rows="4">{{ $dailyLog->description }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-1" />
                            </div>

                            {{-- File Upload --}}
                            <div>
                                <x-input-label for="proof_of_employment" :value="__('Proof Of Employment')" />
                                <input id="proof_of_employment" class="block w-full mt-1 text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm file:cursor-pointer file:border-0 file:py-2.5 file:px-4 file:bg-gray-700 file:hover:bg-indigo-500 duration-500 transition-all file:text-gray-300" type="file" name="proof_of_employment">
                                <x-input-error :messages="$errors->get('proof_of_employment')" class="mt-1" />
                            </div>
                            
                        </div>

                        {{-- Button Submit --}}
                        <div class="flex justify-end mt-4">
                            <x-primary-button>
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>