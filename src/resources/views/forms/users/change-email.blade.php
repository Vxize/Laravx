<div class="mt-4">
    <x-lavx::form.email
        class="block mt-1 w-full" 
        value="{{ old('email') ?? auth()->user()->email ?? '' }}"
        required
        autofocus
    />
</div>