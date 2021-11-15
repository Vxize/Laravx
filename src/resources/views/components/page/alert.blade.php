@props([
    'titleText' => '',
    'titleColor' => 'text-blue-800',
    'subtitleText' => '',
    'subtitleColor' => 'text-green-800',
    'alertText' => '',
    'alertColor' => '',
    'buttonLink' => '',
    'buttonText' => __('lavx::back'),
    'buttonColor' => '',
    'buttonIcon' => 'undo',
    'buttonExternal' => false,
    'returnButtonLink' => '',
    'returnButtonText' => __('lavx::back'),
    'returnButtonColor' => 'green',
    'returnButtonIcon' => 'undo',
    'returnButtonExternal' => false,
    'width' => 'max-w-lg',
    'margin' => 'mx-auto mt-6',
    'errors' => [],
])
<x-lavx::layout.page margin="{{ $margin }}" width="{{ $width }}">
    @if ($titleText)
        <x-lavx::h1
            :color="$titleColor"
            :text="$titleText" 
        />
    @endif
    @if ($subtitleText)
        <x-lavx::h2
            :color="$subtitleColor"
            :text="$subtitleText" 
        />
    @endif
    @if ($returnButtonLink)
        <x-lavx::button
            :link="$returnButtonLink"
            :color="$returnButtonColor"
            :text="$returnButtonText"
            :icon="$returnButtonIcon"
            :external="$returnButtonExternal"
        />
    @endif
    @if (is_array($errors) && !empty($errors))
        <x-lavx::alert color="red" align="text-left">
            <x-lavx::h4>
                <x-lavx::icon icon="times-circle" />
                {{ __('lavx::sys.error') }}
            </x-lavx::h4>
            <x-lavx::ul>
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </x-lavx::ul>
        </x-lavx::alert>
    @endif
    @if ($alertText)
        <x-lavx::alert :color="$alertColor" :text="$alertText" />
    @endif
    @if ($buttonLink)
        <x-lavx::button
            :link="$buttonLink"
            :color="$buttonColor"
            :text="$buttonText"
            :icon="$buttonIcon"
            :external="$buttonExternal"
        />
    @endif
    {{ $slot }}
</x-lavx::layout.page>