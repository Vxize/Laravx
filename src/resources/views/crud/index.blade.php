<x-lavx::crud.index
    title="{{ $title ?? '' }}"
    width="{{ $width ?? 'max-w-7xl' }}"
    margin="{{ $margin ?? 'mx-auto mt-6' }}"
    path="{{ $path ?? '' }}"
    :table=" $table ?? [] "
    :extraTable=" $extra_table ?? [] "
    :columns=" $columns ?? [] "
    :rawColumns=" $raw_columns ?? [] "
    :extraColumns=" $extra_columns ?? [] "
    add="{{ $add ?? true }}"
    download="{{ $download ?? true }}"
    view="{{ $view ?? true }}"
    edit="{{ $edit ?? true }}"
    search="{{ $search ?? true }}"
    delete="{{ $delete ?? true}}"
    textSize="{{ $textSize ?? 'lg:text-lg md:text-base text-sm' }}"
    paginator="{{ $paginator ?? true}}"
    :actionColumn="$actionColumn ?? '' "
    return="{{ $return ?? '' }}"
>
    {{ $slot ?? '' }}
</x-lavx::crud.index>