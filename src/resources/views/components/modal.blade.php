@props([
    'id' => 'modal_id',
    'duration' => 'duration-200',
    'width' => 'w-full',
    'maxWidth' => 'max-w-lg',
    'display' => 'block',
    'zindex' => 'z-50',
    'xdata' => true,
    'closeButton' => null,
    'closeButtonIcon' => 'fa6-solid:xmark',
    'closeButtonColor' => 'gray',
    'closeButtonText' => __('lavx::sys.cancel'),
    'closeButtonDisplay' => 'block',
    'closeButtonWidth' => 'w-full',
    'closeButtonMaxWidth' => 'max-w-full',
    'closeButtonPadding' => 'p-4',
    'closeButtonMargin' => 'mx-auto my-8',
    'closeButtonTextSize' => 'lg:text-2xl md:text-xl text-lg',
    'openButton' => null,
    'openButtonIcon' => 'majesticons:open',
    'openButtonColor' => 'blue',
    'openButtonText' => __('lavx::sys.open'),
    'openButtonDisplay' => 'block',
    'openButtonWidth' => 'w-full',
    'openButtonMaxWidth' => 'max-w-full',
    'openButtonPadding' => 'p-4',
    'openButtonMargin' => 'mx-auto my-8',
    'openButtonTextSize' => 'lg:text-2xl md:text-xl text-lg',
])
<div 
    @if ($xdata)
        x-data="{ {{$id}}: false }"
    @endif
    class="{{ $display }}"
>
    @if (isset($openButton))
        {{ $openButton }}
    @else
        <x-lavx::button
            :icon="$openButtonIcon"
            :color="$openButtonColor"
            link="#"
            :text="$openButtonText"
            :display="$openButtonDisplay"
            :width="$openButtonWidth"
            :maxWidth="$openButtonMaxWidth"
            :padding="$openButtonPadding"
            :margin="$openButtonMargin"
            :textSize="$openButtonTextSize"
            @click.prevent="{{$id}} = true"
        />
    @endif
    <div x-cloak x-show="{{$id}}" class="fixed inset-0 bg-gray-500 bg-opacity-75 {{ $zindex }}"></div>
    <div x-cloak x-show="{{$id}}" class="fixed inset-0 flex items-center justify-center {{ $zindex }}"
        x-transition:enter="transition transform {{$duration}}"
        x-transition:enter-start="scale-0"
        x-transition:enter-end="scale-100"
        x-transition:leave="transition transform {{$duration}}"
        x-transition:leave-start="scale-100"
        x-transition:leave-end="scale-0"
    >
        <div class="bg-white rounded-lg p-8 {{$width}} {{$maxWidth}}">
            {{ $slot }}
            @if (isset($closeButton))
                {{ $closeButton }}
            @else
                <x-lavx::button
                    :icon="$closeButtonIcon"
                    :color="$closeButtonColor"
                    link="#"
                    :text="$closeButtonText"
                    :display="$closeButtonDisplay"
                    :width="$closeButtonWidth"
                    :maxWidth="$closeButtonMaxWidth"
                    :padding="$closeButtonPadding"
                    :margin="$closeButtonMargin"
                    :textSize="$closeButtonTextSize"
                    @click.prevent="{{$id}} = false"
                />
            @endif
        </div>
    </div>
</div>