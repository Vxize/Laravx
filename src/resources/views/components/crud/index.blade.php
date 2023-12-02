@props([
    'title' => '',
    'titleWidth' => 'md:w-4/12',
    'width' => 'max-w-7xl',
    'margin' => 'mx-auto mt-6',
    'path' => '',
    'table' => [],
    'columns' => [],
    'rawColumns' => [],
    'extraColumns' => [],
    'extraTable' => [],
    'actionColumns' => [],
    'actionColumnsText' => [],
    'actionColumnsIcon' => [],
    'add' => true,
    'download' => true,
    'search' => true,
    'view' => true,
    'edit' => true,
    'delete' => true,
    'textSize' => 'lg:text-lg md:text-base text-sm',
    'paginator' => true,
    'return' => '',
    'routeKeyName' => 'id',
    'searchable' => '',
    'filter' => '',
    'filterData' => [],
    'noRecordMessage' => 'lavx::sys.no_record',
    'aboveTable' => '',
    'aboveTableData' => [],
    'belowTable' => '',
    'belowTableData' => [],
])
@php
    if ($download) {
        $download_link = route(
            $path.'.index',
            array_merge(
                request()->query(),
                ['_dl' => 1] 
            )
        );
    }
@endphp
<x-lavx::layout.page margin="{{ $margin }}" width="{{ $width }}">
    <x-lavx::flex class="items-center">
        <div class="w-full {{ $titleWidth }}">
            <x-lavx::h1 text="{{ $title }}" />
        </div>
        @if ($search)
            <div class="w-full md:w-5/12 px-8">
                <x-lavx::form.search
                    action="{{ route($path.'.index', request()->query()) }}"
                    reset="{{ route($path.'.index') }}"
                    searchable="{{ $searchable }}"
                />
            </div>
        @endif
        @if ($add || $download)
            <x-lavx::flex class="w-full md:w-3/12 px-1">
                @if ($add)
                    <div class="px-1 w-full md:w-1/2">
                        <x-lavx::button
                            link="{{ route($path.'.create') }}"
                            text=""
                            icon="fa-solid:plus"
                        />
                    </div>
                @endif
                @if ($download)
                    <div class="px-1 w-full md:w-1/2">
                        <x-lavx::button
                            :link="$download_link"
                            text=""
                            icon="fa-solid:download"
                            color="green"
                        />
                    </div>
                @endif
            </x-lavx::flex>
        @endif
    </x-lavx::flex>

    @includeIf($filter, $filterData)

    @if ($success_message = session('success'))
        <x-lavx::alert color="green" text="{{ $success_message }}" />
    @endif

    @if ($error_message = session('error'))
        <x-lavx::alert color="red" text="{{ $error_message }}" />
    @endif

    @if ($return)
        <x-lavx::button
            link="{{ $return }}"
            color="green"
            width="w-1/3"
        />
    @endif

    @includeIf($aboveTable, $aboveTableData)
    <x-lavx::table
        :table="$table"
        :columns="$columns"
        :rawColumns="$rawColumns"
        :extraColumns="$extraColumns"
        :extraTable="$extraTable"
        :actionColumns="$actionColumns"
        :actionColumnsText="$actionColumnsText"
        :actionColumnsIcon="$actionColumnsIcon"
        :path="$path"
        :view="$view"
        :edit="$edit"
        :delete="$delete"
        :textSize="$textSize"
        :paginator="$paginator"
        :routeKeyName="$routeKeyName"
        :noRecordMessage="$noRecordMessage"
    />
    @includeIf($belowTable, $belowTableData)
    {{ $slot ?? '' }}
</x-lavx::layout.page>