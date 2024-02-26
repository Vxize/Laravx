<x-lavx::crud.edit
    title="{{ $title ?? '' }}"
    margin="{{ $margin ?? 'mx-auto mt-6' }}"
    width="{{ $width ?? 'max-w-lg' }}"
    path="{{ $path ?? '' }}"
    :record="$record ?? []"
    showReturn="{{ $show_return ?? true }}"
    return="{{ $return ?? '' }}"
    action="{{ $action ?? '' }}"
    actionParameter="{{ $action_parameter ?? true }}"
    form="{{ $form ?? '' }}"
    aboveForm="{{ $above_form ?? '' }}"
    :aboveFormData=" $above_form_data ?? [] "
    belowForm="{{ $below_form ?? '' }}"
    :belowFormData=" $below_form_data ?? [] "
    alert="{{ $alert ?? '' }}"
    alertColor="{{ $alert_color ?? 'blue' }}"
    alertEscaped="{{ $alert_escaped ?? false }}"
    submitText="{{ $submit_text ?? 'lavx::sys.save' }}"
    submitColor="{{ $submit_color ?? 'blue' }}"
    submitIcon="{{ $submit_icon ?? 'fa-solid:save' }}"
    submitWidth="{{ $submit_width ?? 'w-full' }}"
    submitDisabled="{{ $submit_disabled ?? false }}"
    routeKeyName="{{ $route_key_name ?? 'id' }}"
    hasUpload="{{ $has_upload ?? false }}"
    :formData="$form_data ?? []"
>
    {{ $slot ?? '' }}
</x-lavx::crud.edit>