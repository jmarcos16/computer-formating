<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Assignment Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your assignment information") }}
        </p>
    </header>

    <form class="mt-6 space-y-3" method="post" action="{{route('assignment.update', $assignment->id)}}">
        @csrf
        @method('PUT')
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                      :value="old('name', $assignment->name)" autofocus autocomplete="name"/>
        <x-input-error class="mt-2" :messages="$errors->get('name')"/>

        <x-primary-button class="mt-6">{{ __('Save assignment') }}</x-primary-button>
    </form>

</section>
