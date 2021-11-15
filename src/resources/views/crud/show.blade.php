<x-lavx::crud.show
    title="{{ $title ?? '' }}"
    width="{{ $width ?? 'max-w-5xl' }}"
    margin="{{ $margin ?? 'mx-auto mt-6' }}"
    showReturn="{{ $show_return ?? true }}"
    return="{{ $return ?? '' }}"
    path="{{ $path ?? '' }}"
    :record=" $record ?? [] "
    :columns=" $columns ?? [] "
    :rawColumns=" $raw_columns ?? [] "
    alert="{{ $alert ?? '' }}"
    alertColor="{{ $alert_color ?? 'blue' }}"
    edit="{{ $edit ?? true }}"
    editRoute="{{ $edit_route ?? '' }}"
    delete="{{ $delete ?? true}}"
    deleteRoute="{{ $delete_route ?? '' }}"
    routeKeyName="{{ $route_key_name ?? 'id' }}"
    textSize="{{ $textSize ?? 'lg:text-lg md:text-base text-sm' }}"
>
    {{ $slot ?? '' }}
</x-lavx::crud.show>