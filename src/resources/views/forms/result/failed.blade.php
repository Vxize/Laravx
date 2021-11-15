<x-lavx::page.alert
    :titleText="$title ?? __('form.submit_error')"
    titleColor="text-red-700"
    alertColor="red"
    :alertText="__('lavx::return_retry')"
    :buttonLink=" $link ?? '' "
    :errors="session('validator_errors') ?? []"
/>