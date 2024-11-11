@props([
    'title' => '',
    'titleWidth' => 'md:w-4/12',
    'width' => 'max-w-full',
    'alert' => '',
    'alertColor' => '',
    'alertEscaped' => false,
    'margin' => '',
    'path' => '',
    'table' => [],
    'columns' => [],
    'columnsHelper' => [],
    'rawColumns' => [],
    'deleteColumns' => [],
    'extraColumns' => [],
    'extraTable' => [],
    'actionColumns' => [],
    'actionColumnsText' => [],
    'actionColumnsIcon' => [],
    'add' => true,
    'addText' => '',
    'download' => true,
    'downloadLink' => '',
    'downloadText' => '',
    'view' => true,
    'edit' => true,
    'delete' => true,
    'textSize' => 'lg:text-lg md:text-base text-sm',
    'paginator' => true,
    'paginate' => null,
    'return' => '',
    'routeKeyName' => 'id',
    'search' => true,
    'searchable' => '',
    'searchAction' => '',
    'filter' => '',
    'filterData' => [],
    'noRecordMessage' => 'lavx::sys.no_record',
    'aboveTable' => '',
    'aboveTableData' => [],
    'belowTable' => '',
    'belowTableData' => [],
])
@php
    if ($download && empty($downloadLink)) {
        $downloadLink = route(
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
            <div class="px-8 w-full {{ ($add || $download) ? 'md:w-5/12' : 'md:w-2/3' }}">
                <x-lavx::form.search
                    action="{{ $searchAction ?: $path.'.index' }}"
                    searchable="{{ $searchable }}"
                />
            </div>
        @endif
        @if ($add || $download)
            <x-lavx::flex class="px-1 w-full {{ $search ? 'md:w-3/12' : 'md:w-1/2' }}">
                @if ($add)
                    <div class="px-1 w-full {{$download ? 'md:w-1/2' : '' }}">
                        <x-lavx::button
                            link="{{ route($path.'.create', request()->query()) }}"
                            text="{{ $addText }}"
                            icon="fa-solid:plus"
                        />
                    </div>
                @endif
                @if ($download)
                    <div class="px-1 w-full {{$add ? 'md:w-1/2' : '' }}">
                        <x-lavx::button
                            :link="$downloadLink"
                            text="{{ $downloadText }}"
                            icon="el:download-alt"
                            color="green"
                        />
                    </div>
                @endif
            </x-lavx::flex>
        @endif
    </x-lavx::flex>

    @if ($return)
        <x-lavx::button
            link="{{ $return }}"
            color="green"
            width="w-full md:w-1/3"
        />
    @endif

    @if ($alert)
        <x-lavx::alert
            :color="$alertColor"
            :text="$alert"
            :escaped="$alertEscaped"
        />
    @endif

    @includeIf($filter, $filterData)

    <x-lavx::page.session />

    @includeIf($aboveTable, $aboveTableData)
    <x-lavx::table
        :table="$table"
        :columns="$columns"
        :columnsHelper="$columnsHelper"
        :rawColumns="$rawColumns"
        :deleteColumns="$deleteColumns"
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
        :paginate="$paginate"
        :routeKeyName="$routeKeyName"
        :noRecordMessage="$noRecordMessage"
    />
    @includeIf($belowTable, $belowTableData)
    {{ $slot ?? '' }}
</x-lavx::layout.page>