<x-lavx::crud.index
    title="{{ $title ?? '' }}"
    titleWidth="{{ $title_width ?? 'md:w-4/12' }}"
    width="{{ $width ?? 'max-w-full' }}"
    margin="{{ $margin ?? 'mx-auto mt-6' }}"
    path="{{ $path ?? '' }}"
    :table=" $table ?? [] "
    :columns=" $columns ?? [] "
    :rawColumns=" $raw_columns ?? [] "
    :extraColumns=" $extra_columns ?? [] "
    :extraTable=" $extra_table ?? [] "
    :actionColumns="$action_columns ?? [] "
    :actionColumnsText=" $action_columns_text ?? [] "
    :actionColumnsIcon=" $action_columns_icon ?? [] "
    add="{{ $add ?? true }}"
    download="{{ $download ?? true }}"
    view="{{ $view ?? true }}"
    edit="{{ $edit ?? true }}"
    search="{{ $search ?? true }}"
    delete="{{ $delete ?? true}}"
    textSize="{{ $text_size ?? 'lg:text-lg md:text-base text-sm' }}"
    paginator="{{ $paginator ?? true}}"
    return="{{ $return ?? '' }}"
    routeKeyName="{{ $route_key_name ?? 'id' }}"
    searchable="{{ $searchable ?? '' }}"
    filter="{{ $filter ?? '' }}"
    :filterData=" $filter_data ?? [] "
    noRecordMessage="{{ $no_record_message ?? 'lavx::sys.no_record' }}"
    aboveTable="{{ $above_table ?? '' }}"
    :aboveTableData=" $above_table_data ?? [] "
    belowTable="{{ $below_table ?? '' }}"
    :belowTableData=" $below_table_data ?? [] "
>
    {{ $slot ?? '' }}
</x-lavx::crud.index>