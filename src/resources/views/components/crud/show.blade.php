@props([
    'title' => '',
    'width' => 'max-w-2xl',
    'margin' => 'mx-auto mt-12',
    'showReturn' => true,
    'return' => '',
    'path' => '',
    'record' => [],
    'columns' => [],
    'rawColumns' => [],
    'hideColumns' => [],
    'alert' => '',
    'alertColor' => 'blue',
    'alertEscaped' => false,
    'edit' => true,
    'editRoute' => '',
    'editText' => '',
    'delete' => true,
    'deleteRoute' => '',
    'routeKeyName' => 'id',
    'textSize' => 'lg:text-lg md:text-base text-sm',
    'aboveTable' => '',
    'aboveTableData' => [],
    'belowTable' => '',
    'belowTableData' => [],
])
<x-lavx::layout.page margin="{{ $margin }}" width="{{ $width }}">
    <x-lavx::h1 text="{{ $title }}" />
    @if ($showReturn)
        <x-lavx::button
            link="{{ $return ?: url()->previous() ?: route($path.'.index') }}"
            color="green"
            width="w-1/2"
        />
    @endif
    @if ($alert)
        <x-lavx::alert text="{{ $alert }}" color="{{ $alertColor }}" escaped="{{ $alertEscaped }}" />
    @endif

    @includeIf($aboveTable, $aboveTableData ?: ['record' => $record])

    <x-lavx::dl
        :record="$record"
        :columns="$columns"
        :rawColumns="$rawColumns"
        :hideColumns="$hideColumns"
        :textSize="$textSize"
    />

    @includeIf($belowTable, $belowTableData ?: ['record' => $record])

    @if ($edit)
        <x-lavx::button
            link="{{ route($editRoute ?: $path.'.edit', Arr::get($record, $routeKeyName)) }}"
            icon="pen-to-square"
            text="{{ __($editText ?: 'lavx::sys.edit') }}"
            width="w-1/2"
        />
    @endif
    @if ($delete)
        <div x-data="{ del : false }">
            <x-lavx::button
                icon="trash-can"
                color="red"
                :text="__('lavx::sys.delete')"
                link="#"
                width="w-1/2"
                @click.prevent=" del = true"
            />
            <div x-cloak x-show="del" x-transition class="p-3 mx-auto max-w-md bg-white border border-gray-300 rounded-lg shadow-lg mt-2 text-center">
                <x-lavx::h3 :text="__('lavx::sys.confirm').__('lavx::sys.delete').'？'" class="text-red-600 font-semibold" />
                <x-lavx::h4 :text="__('lavx::sys.data_cannot_recover')" class="text-red-600 font-semibold" />
                <x-lavx::flex>
                    <div class="w-full md:w-1/2 p-2">
                        <x-lavx::form
                            action="{{ route($deleteRoute ?: $path.'.destroy', $record->{$routeKeyName}) }}"
                            type="delete"
                            submitText="lavx::sys.yes"
                            submitIcon="check"
                            submitColor="red"
                            showError="0"
                        />
                    </div>
                    <div class="w-full md:w-1/2 p-2">
                        <x-lavx::button
                            icon="xmark"
                            color="green"
                            display="inline-block"
                            :text="__('lavx::sys.no')"
                            link="#"
                            @click.prevent="del = false"
                        />
                    </div>
                </x-lavx::flex>
            </div>
        </div>
    @endif
    {{ $slot ?? '' }}
</x-lavx::layout.page>