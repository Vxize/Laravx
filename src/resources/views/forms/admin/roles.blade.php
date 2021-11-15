<div>
    <x-lavx::form.input
        :label="__('lavx::sys.name')"
        class="block mt-1 w-full"
        type="text"
        name="name"
        value="{{ old('name') ?? $record->name ?? '' }}"
        required 
    />
</div>