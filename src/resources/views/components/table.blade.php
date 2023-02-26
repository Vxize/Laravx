@props([
    'path' => '',
    'table' => [],
    'extraTable' => [],
    'columns' => [],
    'rawColumns' => [],
    'extraColumns' => [],
    'actionColumnText' => [],
    'actionColumnIcon' => [],
    'view' => true,
    'edit' => true,
    'delete' => true,
    'textSize' => 'lg:text-lg md:text-base text-sm',
    'paginator' => true,
    'actionColumn' => '',
    'routeKeyName' => 'id',
    'noRecordMessage' => 'lavx::sys.no_record',
    'above_table' => '',
    'below_table' => '',
])
@php
    $table_class = 'border-collapse min-w-full table-fixed divide-y divide-gray-300 '.$textSize;
    $action = $view || $edit || $delete;
    if ($action && !$actionColumn) {
        $default_action_column = [];
        if ($view)  $default_action_column[] = $actionColumnText['view'] ?? __('lavx::sys.view');
        if ($edit)  $default_action_column[] = $actionColumnText['edit'] ?? __('lavx::sys.edit');
        if ($delete)  $default_action_column[] = $actionColumnText['delete'] ?? __('lavx::sys.delete');
        $default_action_column = implode(' | ', $default_action_column);
    }
@endphp

{{ $above_table }}

@if ($table->isEmpty())
    <x-lavx::h2 color="text-red-600" text="{{ __($noRecordMessage) }}" />
@else
    <div class="overflow-x-auto overflow-y-hidden rounded-lg shadow-lg my-4 border border-gray-300">
        <table class="{{ $table_class }}">
            <thead>
                <tr class="bg-gray-300 uppercase leading-normal text-left">
                    @foreach ($columns as $col)
                        <th class="py-3 px-6">{{ __($col) }}</th>
                    @endforeach
                    @foreach ($extraColumns as $add_col)
                        <th class="py-3 px-6">{{ __($add_col) }}</th>
                    @endforeach
                    @if ($action)
                        <th class="py-3 px-6 w-56 text-center">{{ $actionColumn ?: ($default_action_column ?? '') }}</th>
                    @endif    
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach ($table as $num => $row)
                    <tr class="hover:bg-gray-200 whitespace-nowrap {{ $loop->even ? 'bg-gray-100' : '' }}">
                        @foreach ($columns as $key => $col)
                            <td class="py-2 px-6">
                                @if (!empty($rawColumns) && in_array($key, $rawColumns))
                                    {!! Arr::get($row, $key, '') !!}
                                @else
                                    {{ Arr::get($row, $key, '') }}
                                @endif
                            </td>
                        @endforeach
                        @foreach ($extraColumns as $add_key => $add_col)
                            @if (isset($extraTable[$num][$add_key]['type'])
                                && $extraTable[$num][$add_key]['type'] === 'button'
                            )
                                <td class="py-2 px-6">
                                    <x-lavx::button
                                        icon="{{ $extraTable[$num][$add_key]['icon'] ?? 'info-circle' }}"
                                        color="{{ $extraTable[$num][$add_key]['color'] ?? 'blue' }}"
                                        display="inline-block"
                                        text=""
                                        link="{{ $extraTable[$num][$add_key]['link'] ?? '' }}"
                                        padding="p-2"
                                        margin="my-0 mx-auto"
                                        width="w-12"
                                        textSize='lg:text-lg md:text-base text-sm'
                                    />
                                </td>
                            @else
                                <td class="py-2 px-6">{{ $extraTable[$num][$add_key] ?? '' }}</td>
                            @endif
                        @endforeach
                        @if ($action)
                            <td class="py-2 px-6 text-center">
                                @if ($view)
                                    <x-lavx::button
                                        icon="{{ $actionColumnIcon['view'] ?? 'circle-info' }}"
                                        color="blue"
                                        display="inline-block"
                                        text=""
                                        link="{{ route($path.'.show', Arr::get($row, $routeKeyName)) }}"
                                        padding="p-2"
                                        margin="my-0 mx-auto"
                                        width="w-12"
                                        textSize='lg:text-lg md:text-base text-sm'
                                    />
                                @endif
                                @if ($edit)
                                    <x-lavx::button
                                        icon="{{ $actionColumnIcon['edit'] ?? 'pen-to-square' }}"
                                        color="purple"
                                        display="inline-block"
                                        text=""
                                        link="{{ route($path.'.edit', Arr::get($row, $routeKeyName)) }}"
                                        padding="p-2"
                                        margin="my-0 mx-auto"
                                        width="w-12"
                                        textSize='lg:text-lg md:text-base text-sm'
                                    />
                                @endif
                                @if ($delete)
                                    <span x-data="{ delete_{{Arr::get($row, $routeKeyName)}} : false }">
                                        <x-lavx::button
                                            icon="{{ $actionColumnIcon['delete'] ?? 'trash-can' }}"
                                            color="red"
                                            display="inline-block"
                                            text=""
                                            link="#"
                                            padding="p-2"
                                            margin="my-0 mx-auto"
                                            width="w-12"
                                            textSize='lg:text-lg md:text-base text-sm'
                                            @click.prevent=" delete_{{Arr::get($row, $routeKeyName)}} = true"
                                        />
                                        <div x-cloak x-show="delete_{{Arr::get($row, $routeKeyName)}}" x-transition class="p-3 max-w-md bg-white border border-gray-300 rounded-lg shadow-lg mt-2">
                                            <x-lavx::h5 :text="__('lavx::sys.confirm').__('lavx::sys.delete').'？'" class="text-red-600 font-semibold" />
                                            <x-lavx::p :text="__('lavx::sys.data_cannot_recover')" class="text-red-600 font-semibold" />
                                            <x-lavx::form
                                                action="{{ route($path.'.destroy', Arr::get($row, $routeKeyName)) }}"
                                                type="delete"
                                                class="inline-block"
                                                showError="0"
                                            >
                                                <x-slot:submit>
                                                    <x-lavx::form.submit
                                                        icon="check"
                                                        color="red"
                                                        display="inline-block"
                                                        text=""
                                                        padding="p-2"
                                                        margin="my-0 mx-auto"
                                                        width="w-14"
                                                        textSize='lg:text-lg md:text-base text-sm'
                                                    />
                                                </x-slot>
                                            </x-lavx::form>
                                            <x-lavx::button
                                                icon="xmark"
                                                color="green"
                                                display="inline-block"
                                                text=""
                                                link="#"
                                                padding="p-2"
                                                margin="my-0 mx-auto"
                                                width="w-16"
                                                textSize='lg:text-lg md:text-base text-sm'
                                                @click.prevent=" delete_{{Arr::get($row, $routeKeyName)}} = false"
                                            />
                                        </div>
                                    </span>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($paginator)
        <div class="p-3">{!! $table->withQueryString()->onEachSide(1)->links('lavx::paginator') ?? ''  !!}</div>
    @endif
@endif
{{ $below_table }}