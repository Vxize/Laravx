@props([
    'title' => '',
    'width' => 'max-w-7xl',
    'margin' => 'mx-auto mt-6',
    'path' => '',
    'table' => [],
    'extraTable' => [],
    'columns' => [],
    'rawColumns' => [],
    'extraColumns' => [],
    'add' => true,
    'download' => true,
    'search' => true,
    'view' => true,
    'edit' => true,
    'delete' => true,
    'textSize' => 'lg:text-lg md:text-base text-sm',
    'paginator' => true,
    'actionColumn' => '',
    'return' => '',
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
        <div class="w-full md:w-4/12">
            <x-lavx::h1 text="{{ $title }}" />
        </div>
        @if ($search)
            <div class="w-full md:w-5/12 px-8">
                <x-lavx::form.search
                    action="{{ route($path.'.index') }}"
                    reset="{{ route($path.'.index') }}"
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
                            icon="plus"
                        />
                    </div>
                @endif
                @if ($download)
                    <div class="px-1 w-full md:w-1/2">
                        <x-lavx::button
                            :link="$download_link"
                            text=""
                            icon="download"
                            color="green"
                        />
                    </div>
                @endif
            </x-lavx::flex>
        @endif
    </x-lavx::flex>

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

    <x-lavx::table
        :table="$table"
        :extraTable="$extraTable"
        :columns="$columns"
        :rawColumns="$rawColumns"
        :extraColumns="$extraColumns"
        :path="$path"
        :view="$view"
        :edit="$edit"
        :delete="$delete"
        :textSize="$textSize"
        :paginator="$paginator"
        :actionColumn="$actionColumn"
    />
    {{ $slot ?? '' }}
</x-lavx::layout.page>