@props([
    'path' => '',
    'table' => [],
    'columns' => [],
    'rawColumns' => [],
    'extraColumns' => [],
    'extraTable' => [],
    'actionColumns' => [],
    'actionColumnsText' => [],
    'actionColumnsIcon' => [],
    'view' => true,
    'edit' => true,
    'delete' => true,
    'textSize' => 'lg:text-lg md:text-base text-sm',
    'paginator' => true,
    'routeKeyName' => 'id',
    'noRecordMessage' => 'lavx::sys.no_record',
])
@php
    $table_class = 'border-collapse min-w-full table-fixed divide-y divide-gray-300 '.$textSize;
    $action = $view || $edit || $delete || ! empty($actionColumns);
    if ($action) {
        $action_column_header = [];
        if ($view) {
            $action_column_header['view'] = $actionColumnsText['view'] ?? __('lavx::sys.view');
        }
        if ($edit) {
            $action_column_header['edit'] = $actionColumnsText['edit'] ?? __('lavx::sys.edit');
        }
        if ($delete) {
            $action_column_header['delete'] = $actionColumnsText['delete'] ?? __('lavx::sys.delete');
        }
        if (! empty($actionColumns)) {
            foreach ($actionColumns as $key => $value) {
                $action_column_header[$key] = __($value);
            }
        }
        $action_column_header = implode(' | ', $action_column_header);
    }
@endphp

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
                        <th class="py-3 px-6 text-center md:sticky right-0 bg-lime-100 border-l">{{ $action_column_header ?? '' }}</th>
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
                            <td class="py-2 px-6">{{ $extraTable[$num][$add_key] ?? '' }}</td>
                        @endforeach
                        @if ($action)
                            <td class="py-2 px-6 text-center md:sticky right-0 bg-lime-100 hover:bg-gray-200 border-l">
                                @if ($view)
                                    <x-lavx::button
                                        icon="{{ $actionColumnsIcon['view'] ?? 'circle-info' }}"
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
                                        icon="{{ $actionColumnsIcon['edit'] ?? 'pen-to-square' }}"
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
                                            icon="{{ $actionColumnsIcon['delete'] ?? 'trash-can' }}"
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
                                @foreach ($actionColumns as $add_key => $add_col)
                                    @if (isset($extraTable[$num][$add_key]['type'])
                                        && $extraTable[$num][$add_key]['type'] === 'button'
                                    )
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
                                    @endif
                                @endforeach
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