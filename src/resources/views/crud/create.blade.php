<x-lavx::crud.create
    title="{{ $title ?? '' }}"
    margin="{{ $margin ?? 'mx-auto mt-6' }}"
    path="{{ $path ?? '' }}"
    showReturn="{{ $show_return ?? true }}"
    return="{{ $return ?? '' }}"
    action="{{ $action ?? '' }}"
    form="{{ $form ?? '' }}"
    aboveForm="{{ $above_form ?? '' }}"
    :alert=" $alert ?? '' "
    alertColor="{{ $alert_color ?? 'blue' }}"
    alertEscaped="{{ $alert_escaped ?? false }}"
    submitText="{{ $submit_text ?? 'lavx::sys.save' }}"
    submitColor="{{ $submit_color ?? 'blue' }}"
    submitIcon="{{ $submit_icon ?? 'save' }}"
    submitWidth="{{ $submit_width ?? 'w-full' }}"
    submitDisabled="{{ $submit_disabled ?? false }}"
    :formData="$form_data ?? []"
>
    {{ $slot ?? '' }}
</x-lavx::crud.create>