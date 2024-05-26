<x-lavx::flex class="items-center">
    <div class="w-full mx-auto text-center">
        <x-lavx::form.json
            :route=" $route ?? '' "
            :showError=" $show_error ?? '' "
            :hiddenInputs=" $hidden_inputs ?? [] "
        ></x-lavx::form.json>
    </div>
</x-lavx::flex>