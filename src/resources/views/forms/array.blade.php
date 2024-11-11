<x-lavx::flex class="items-center">
    <div class="w-full mx-auto text-center">
        <x-lavx::form.array
            :route=" $route ?? '' "
            :showError=" $show_error ?? '' "
            :hiddenInputs=" $hidden_inputs ?? [] "
            :keyName=" $key_name ?? 'key' "
        ></x-lavx::form.array>
    </div>
</x-lavx::flex>