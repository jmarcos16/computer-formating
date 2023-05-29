<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a Assignment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{route('assignment.store')}}" >
                        @csrf
                        <div class="my-2">
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Title Assignment"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="my-2">
                            <x-input-label for="description" value="Description" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" placeholder="Description Assignment"/>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <x-primary-button class="my-2">
                            {{ __('Create') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
