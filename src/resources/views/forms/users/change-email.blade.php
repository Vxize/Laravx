<div>
    <x-lavx::form.email
        value="{{ old('email') ?? auth()->user()->email ?? '' }}"
        required
        autofocus
    />
</div>