<div>
    <x-lavx::form.email required autofocus />
</div>

<x-slot:above_form>
    <!-- Session Status -->
    <x-lavx::form.status :status="session('status')" />
</x-slot>