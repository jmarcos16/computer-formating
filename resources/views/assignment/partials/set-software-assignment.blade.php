<section>
    <header class="flex justify-between items-center">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Software Assigment') }}
        </h2>
        <form action="{{route('assignment.software.store', $assignment->id)}}" method="post">
            @csrf
            <label>
                <select id="software_id" name="software_id"
                        class=" border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="0" disabled selected>Select Software</option>
                    @foreach($softwares as $software)
                        <option value="{{$software->id}}">{{$software->name}}</option>
                    @endforeach
                </select>
            </label>

            <x-primary-button class="h-10">
                {{ __('Add Software') }}
            </x-primary-button>
            <x-input-error :messages="$errors->get('software_id')" class="mt-2"/>
        </form>

    </header>

    <div class="mt-2">
        <table class="w-full">
            <tr class="bg-gray-100 dark:bg-gray-800">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Link</th>
                <th class="px-4 py-2">Action</th>
            </tr>
            @if($assignment->softwares()->count() > 0)
                @foreach($assignment->softwares()->get() as $software)
                    <tr class="bg-white dark:bg-gray-900 align-middle">
                        <td class="border-b text-sm  px-4 py-2">{{$software->name}}</td>
                        <td class="border-b text-sm  px-4 py-2">{{$software->description}}</td>
                        <td class="border-b text-sm  px-4 py-2">{{$software->link}}</td>
                        <td class="border-b text-sm  px-4 py-2">
                            <x-danger-button>{{ __('Delete') }}</x-danger-button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="bg-white dark:bg-gray-900">
                    <td class="border-b text-sm text-center px-4 py-2" colspan="4">No software assigned</td>
                </tr>
            @endif
        </table>
    </div>
</section>
