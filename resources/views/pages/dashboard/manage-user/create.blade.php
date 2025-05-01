<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Button Go Back to Index --}}
            <div class="flex justify-start mb-4">
                <a href="{{ route('manage-user.index') }}" class="inline-block px-4 py-2 text-left bg-indigo-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                    Go Back
                </a>
            </div>

            {{-- Form --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-md">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('manage-user.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                            {{-- Name Input --}}
                            <div class="col-span-2">
                                <x-input-label for="name" :value="__('Name Employee')" />
                                <x-text-input id="name" class="block w-full mt-1 text-sm" type="text" name="name" :value="old('name')" placeholder="Input employee name here..." />
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>

                            {{-- Email Input --}}
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block w-full mt-1 text-sm" type="email" name="email" :value="old('email')" placeholder="Input email here..." />
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>

                            {{-- Password Input --}}
                            <div>
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="block w-full mt-1 text-sm" type="password" name="password" :value="old('password')" placeholder="Input password here..." />
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>
                            
                            {{-- Position Select Input --}}
                            <div>
                                <x-input-label for="position_id" :value="__('Position')" />
                                <select id="position_id" name="position_id" class="block w-full mt-1 text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option selected>Select Position</option>
                                    @forelse ($positions as $item)
                                        <option value={{ $item->id }}>{{ $item->name }}</option>
                                    @empty
                                        {{-- empty --}}
                                    @endforelse
                                </select>
                                <x-input-error :messages="$errors->get('position_id')" class="mt-1" />
                            </div>

                            {{-- Manage by Select Input --}}
                            <div>
                                <x-input-label for="manage_by" :value="__('Manage By')" />
                                <select id="manage_by" name="manage_by" class="block w-full mt-1 text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option selected>Select Position</option>
                                    @forelse ($manage_by as $item)
                                        <option value={{ $item->id }}>{{ $item->name }}</option>
                                    @empty
                                        {{-- empty --}}
                                    @endforelse
                                </select>
                                <x-input-error :messages="$errors->get('manage_by')" class="mt-1" />
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