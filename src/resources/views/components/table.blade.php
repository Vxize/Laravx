@props([
    'path' => '',
    'table' => [],
    'extraTable' => [],
    'columns' => [],
    'rawColumns' => [],
    'extraColumns' => [],
    'view' => true,
    'edit' => true,
    'delete' => true,
    'textSize' => 'lg:text-lg md:text-base text-sm',
    'paginator' => true,
    'actionColumn' => '',
])
@php
    $table_class = 'border-collapse min-w-full table-fixed divide-y divide-gray-300 '.$textSize;
    $action = $view || $edit || $delete;
    if ($action && !$actionColumn) {
        $default_action_column = [];
        if ($view)  $default_action_column[] = __('lavx::sys.view');
        if ($edit)  $default_action_column[] = __('lavx::sys.edit');
        if ($delete)  $default_action_column[] = __('lavx::sys.delete');
        $default_action_column = implode(' | ', $default_action_column);
    }
@endphp

@if ($table->isEmpty())
    <x-lavx::h2 color="text-red-600" text="{{ __('lavx::sys.no_record') }}" />
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
                                        icon="info-circle"
                                        color="blue"
                                        display="inline-block"
                                        text=""
                                        link="{{ route($path.'.show', Arr::get($row, 'id')) }}"
                                        padding="p-2"
                                        margin="my-0 mx-auto"
                                        width="w-12"
                                        textSize='lg:text-lg md:text-base text-sm'
                                    />
                                @endif
                                @if ($edit)
                                    <x-lavx::button
                                        icon="edit"
                                        color="purple"
                                        display="inline-block"
                                        text=""
                                        link="{{ route($path.'.edit', Arr::get($row, 'id')) }}"
                                        padding="p-2"
                                        margin="my-0 mx-auto"
                                        width="w-12"
                                        textSize='lg:text-lg md:text-base text-sm'
                                    />
                                @endif
                                @if ($delete)
                                    <span x-data="{ delete_{{Arr::get($row, 'id')}} : false }">
                                        <x-lavx::button
                                            icon="trash-alt"
                                            color="red"
                                            display="inline-block"
                                            text=""
                                            link="#"
                                            padding="p-2"
                                            margin="my-0 mx-auto"
                                            width="w-12"
                                            textSize='lg:text-lg md:text-base text-sm'
                                            @click=" delete_{{Arr::get($row, 'id')}} = true"
                                        />
                                        <div x-cloak x-show="delete_{{Arr::get($row, 'id')}}" x-transition class="p-3 max-w-md bg-white border border-gray-300 rounded-lg shadow-lg mt-2">
                                            <x-lavx::h5 :text="__('lavx::sys.confirm').__('lavx::sys.delete').'？'" class="text-red-600 font-semibold" />
                                            <x-lavx::p :text="__('lavx::sys.data_cannot_recover')" class="text-red-600 font-semibold" />
                                            <x-lavx::form
                                                action="{{ route($path.'.destroy', Arr::get($row, 'id')) }}"
                                                type="delete"
                                                class="inline-block"
                                                showError="0"
                                            >
                                                <x-slot name="submit">
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
                                                icon="times"
                                                color="green"
                                                display="inline-block"
                                                text=""
                                                link="#"
                                                padding="p-2"
                                                margin="my-0 mx-auto"
                                                width="w-16"
                                                textSize='lg:text-lg md:text-base text-sm'
                                                @click=" delete_{{Arr::get($row, 'id')}} = false"
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
        <div class="p-3">{!! $table->withQueryString()->links('lavx::paginator') ?? ''  !!}</div>
    @endif
@endif