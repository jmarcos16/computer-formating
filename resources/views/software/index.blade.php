<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List All Software') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ">
                <div class=" text-gray-900 dark:text-gray-100">

                    <div
                        class="pb-3 px-2 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        <x-primary-button class="mt-4">
                            <a href="{{ route('software.create') }}">Create new</a>
                        </x-primary-button>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Software Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Link
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($softwares->count() > 0)
                                @foreach ($softwares as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->description }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a target="blank" href="{{ $item->link }}">{{ $item->link }}</a>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center gap-2 justify-end">
                                                
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="4" class="px-6 py-4 text-center">
                                        No data found
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="px-2 py-2">
                            {{ $softwares->links() }}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
