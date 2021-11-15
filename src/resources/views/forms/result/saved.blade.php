<x-lavx::page.alert
    :titleText="$title ?? __('form.submit_success')"
    titleColor="text-green-800"
    alertColor="green"
    :alertText="__('form.save_success')"
    :buttonLink="$link ?? '' "
/>