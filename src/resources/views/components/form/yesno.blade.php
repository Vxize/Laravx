@props([
    'name' => '',
    'checked' => '',
    'required' => false,
])
<x-lavx::form.radio
    :name="$name"
    :checked="isset($checked) && intval($checked) === 1"
    :label="__('lavx::sys.yes')"
    value=1
    :required="$required"
/>
<x-lavx::form.radio
    :name="$name"
    :checked="isset($checked) && $checked !== '' && intval($checked) === 0"
    :label="__('lavx::sys.no')"
    value=0
    :required="$required"
/>