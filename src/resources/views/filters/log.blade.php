<x-lavx::flex class="items-center">
    <div class="w-full mx-auto text-center">
        <x-lavx::form.filter route="admin.logs.index">
            <x-lavx::form.input
                :label="__('lavx::log.log_name')"
                labelDisplay="inline-block"
                class="inline-block mt-1 w-40"
                type="text"
                name="log_name"
                value="{{ request()->input('log_name') ?? '' }}"
            />
            <x-lavx::form.input
                :label="__('lavx::user.user')"
                labelDisplay="inline-block"
                class="inline-block mt-1 w-24"
                type="text"
                name="user_id"
                value="{{ request()->input('user_id') ?? '' }}"
            />
        </x-lavx::form.filter>
    </div>
</x-lavx::flex>