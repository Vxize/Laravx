<x-lavx::crud.edit
    title="{{ $title ?? '' }}"
    margin="{{ $margin ?? 'mx-auto mt-6' }}"
    path="{{ $path ?? '' }}"
    :record="$record ?? []"
    showReturn="{{ $show_return ?? true }}"
    return="{{ $return ?? '' }}"
    action="{{ $action ?? '' }}"
    form="{{ $form ?? '' }}"
    aboveForm="{{ $above_form ?? '' }}"
    alert="{{ $alert ?? '' }}"
    alertColor="{{ $alert_color ?? 'blue' }}"
    submitText="{{ $submit_text ?? 'lavx::save' }}"
    submitColor="{{ $submit_color ?? 'blue' }}"
    submitIcon="{{ $submit_icon ?? 'save' }}"
    submitWidth="{{ $submit_width ?? 'w-full' }}"
    submitDisabled="{{ $submit_disabled ?? false }}"
    routeKeyName="{{ $route_key_name ?? 'id' }}"
    hasUpload="{{ $has_upload ?? false }}"
    :formData="$form_data ?? []"
>
    {{ $slot ?? '' }}
</x-lavx::crud.edit>