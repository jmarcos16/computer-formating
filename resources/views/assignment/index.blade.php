<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List All Assignment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ">
                <div class=" text-gray-900 dark:text-gray-100">

                    <div
                        class="pb-3 px-2 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        <x-primary-button class="mt-4">
                            <a href="{{ route('assignment.create') }}">Create new</a>
                        </x-primary-button>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Assignment Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Last Updated
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($assignments->count() > 0)
                                @foreach($assignments as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$item->name}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$item->updated_at}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$item->created_at}}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center gap-2 justify-end">
                                                <a href="{{route('assignment.edit', $item->id)}}"
                                                   class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Management</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="4" class="px-6 py-4 text-center">
                                        <span class="dark:text-gray-200">No data found</span>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="px-2 py-2">
                            {{ $assignments->links() }}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
