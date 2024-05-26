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
    'editId' => null,
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
            link="{{ route($editRoute ?: $path.'.edit', $editId ?: Arr::get($record, $routeKeyName)) }}"
            icon="fa6-solid:pen-to-square"
            text="{{ __($editText ?: 'lavx::sys.edit') }}"
            width="w-1/2"
        />
    @endif
    @if ($delete)
        <x-lavx::modal
            id="del"
            maxWidth="max-w-sm"
            openButtonIcon="fa6-solid:trash-can"
            openButtonColor="red"
            openButtonText="{{__('lavx::sys.delete')}}"
            openButtonWidth="w-1/2"
        >
            <x-lavx::h2 :text="__('lavx::sys.confirm').__('lavx::sys.delete').'？'" class="text-red-600 font-semibold" />
            <x-lavx::alert :text="__('lavx::sys.data_cannot_recover')" color="red" />
            <x-lavx::form
                action="{{ route($deleteRoute ?: $path.'.destroy', $record->{$routeKeyName}) }}"
                type="delete"
                showError="0"
                submitText="lavx::sys.confirm"
                submitIcon="fa6-solid:check"
                submitColor="red"
            />
        </x-lavx::modal>
    @endif
    {{ $slot ?? '' }}
</x-lavx::layout.page>