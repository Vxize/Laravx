@props([
    'checklist' => [],
    'checked' => [],
])
@foreach ($checklist as $checkbox)
    <x-lavx::form.checkbox
        :disabled=" $checkbox['disabled'] ?? false "
        :id=" $checkbox['id'] ?? null ",
        :name=" $checkbox['name'] ?? '' ",
        :label=" $checkbox['label'] ?? '' ",
        :value=" $checkbox['value'] ?? 1 ",
        :checked=" in_array($checkbox['name'], $checked) ",
    />
@endforeach