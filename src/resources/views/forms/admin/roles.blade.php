<div>
    <x-lavx::form.input
        :label="__('lavx::sys.name')"
        type="text"
        name="name"
        value="{{ old('name') ?? $record->name ?? '' }}"
        required 
    />
</div>