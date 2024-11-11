@props([
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
    'view' => true,
    'edit' => true,
    'delete' => true,
    'textSize' => 'lg:text-lg md:text-base text-sm',
    'paginator' => true,
    'paginate' => null,
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
                    @foreach ($extraColumns as $extra_name => $extra_col)
                        <th class="py-3 px-6">
                            @if (! empty($columnsHelper[$extra_name]))
                                <x-lavx::tooltip
                                    :titleText=" __($extra_col) "
                                    :helperText="$columnsHelper[$extra_name]"
                                />
                            @else
                                {{ __($extra_col) }}
                            @endif
                        </th>
                    @endforeach
                    @if ($action)
                        <th class="py-3 px-6 text-center md:sticky right-0 bg-lime-100 border-l">{{ $action_column_header ?? '' }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach ($table as $num => $row)
                    <tr class="hover:bg-gray-200 whitespace-nowrap {{ $loop->even ? 'bg-gray-100' : '' }}"
                        @if ($delete)
                            x-data="{ delete_{{Arr::get($row, $routeKeyName)}} : false }"
                        @endif
                    >
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
                            <td class="py-2 px-6">
                                @if (!empty($rawColumns) && in_array($add_key, $rawColumns))
                                    {!! $extraTable[$num][$add_key] ?? '' !!}
                                @else
                                    {{ $extraTable[$num][$add_key] ?? '' }}
                                @endif
                            </td>
                        @endforeach
                        @if ($action)
                            <td class="py-2 px-6 text-center md:sticky right-0 bg-lime-100 hover:bg-gray-200 border-l">
                                @if ($view)
                                    <x-lavx::button
                                        icon="{{ $actionColumnsIcon['view'] ?? 'fa6-solid:circle-info' }}"
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
                                        icon="{{ $actionColumnsIcon['edit'] ?? 'fa6-solid:pen-to-square' }}"
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
                                    <x-lavx::button
                                        icon="{{ $actionColumnsIcon['delete'] ?? 'fa6-solid:trash-can' }}"
                                        color="red"
                                        display="inline-block"
                                        text=""
                                        link="#"
                                        padding="p-2"
                                        margin="my-0 mx-auto"
                                        width="w-12"
                                        textSize='lg:text-lg md:text-base text-sm'
                                        @click.prevent="delete_{{Arr::get($row, $routeKeyName)}} = true"
                                    />
                                @endif
                                @foreach ($actionColumns as $add_key => $add_col)
                                    @if (isset($extraTable[$num][$add_key]['type'])
                                        && $extraTable[$num][$add_key]['type'] === 'button'
                                    )
                                        <x-lavx::button
                                            icon="{{ $extraTable[$num][$add_key]['icon'] ?? 'fa6-solid:circle-info' }}"
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
                        @if ($delete)
                            <td>
                                <x-lavx::modal
                                    id="delete_{{Arr::get($row, $routeKeyName)}}"
                                    maxWidth="max-w-sm"
                                    openButton=""
                                    xdata=0
                                >
                                    <x-lavx::h2 :text="__('lavx::sys.confirm').__('lavx::sys.delete').'？'" class="text-red-600 font-semibold" />
                                    <x-lavx::alert :text="__('lavx::sys.data_cannot_recover')" color="red" />
                                    <x-lavx::form
                                        action="{{ route($path.'.destroy', Arr::get($row, $routeKeyName)) }}"
                                        type="delete"
                                        showError="0"
                                        submitText="lavx::sys.confirm"
                                        submitIcon="fa6-solid:check"
                                        submitColor="red"
                                    >
                                        @foreach ($deleteColumns as $delete_column)
                                            <input type="hidden" name="{{ $delete_column }}" value="{{ Arr::get($row, $delete_column) }}" />
                                        @endforeach
                                    </x-lavx::form>
                                </x-lavx::modal>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($paginator)
        <div class="p-3">{!! $table->withQueryString()->onEachSide(1)->links('lavx::paginator', ['paginate' => $paginate]) ?? ''  !!}</div>
    @endif
@endif