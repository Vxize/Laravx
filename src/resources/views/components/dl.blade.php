@props([
    'record' => [],
    'columns' => [],
    'rawColumns' => [],
    'textSize' => 'lg:text-lg md:text-base text-sm',
])

@if (empty($record))
    <x-lavx::h2 color="text-red-600" text="{{ __('lavx::no_record') }}" />
@else
    <div class="overflow-x-auto overflow-y-hidden rounded-lg shadow-lg border border-gray-300 my-4">
        <dl class="{{ $textSize }} divide-y divide-gray-300">
            @foreach ($columns as $key => $col)
                <x-lavx::flex class="hover:bg-gray-200 p-5 {{ $loop->even ? 'bg-gray-100' : '' }} ">
                    <dt class="font-semibold w-full md:w-1/3 p-1">
                        {{ __($col) }}
                    </dt>
                    <dd class="ml-4 md:ml-0 w-full md:w-2/3 p-1">
                        @if (!empty($rawColumns) && in_array($key, $rawColumns))
                            {!! Arr::get($record, $key, '') !!}
                        @else
                            {{ Arr::get($record, $key, '') }}
                        @endif
                    </dd>
                </x-lavx::flex>
            @endforeach
        </dl>
    </div>
@endif