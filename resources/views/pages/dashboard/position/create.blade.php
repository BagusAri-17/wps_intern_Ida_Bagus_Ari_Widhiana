<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Position') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Button Go Back to Index --}}
            <div class="flex justify-start mb-4">
                <a href="{{ route('manage-position.index') }}" class="inline-block px-4 py-2 text-left bg-indigo-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                    Go Back
                </a>
            </div>

            {{-- Form --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-md">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('manage-position.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                            {{-- Name Input --}}
                            <div>
                                <x-input-label for="name" :value="__('Name Position')" />
                                <x-text-input id="name" class="block w-full mt-1 text-sm" type="text" name="name" :value="old('name')" placeholder="Input position name here..." />
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>
                            
                            {{-- Level Select Input --}}
                            <div>
                                <x-input-label for="level" :value="__('Level Position')" />
                                <select id="level" name="level" class="block w-full mt-1 text-sm text-gray-300 bg-gray-900 border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option selected>Select Level of Position</option>
                                    <option value="2">Manager</option>
                                    <option value="3">Staff</option>
                                </select>
                                <x-input-error :messages="$errors->get('level')" class="mt-1" />
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