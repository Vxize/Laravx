<div>
    <x-lavx::form.email class="block mt-1 w-full" required autofocus />
</div>

<x-slot:above_form>
    <!-- Session Status -->
    <x-lavx::form.status :status="session('status')" />
</x-slot>