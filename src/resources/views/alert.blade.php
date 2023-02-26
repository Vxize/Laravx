<x-lavx::layout.page :width="$width ?? 'max-w-lg' ">
    @if (! empty($title))
        <x-lavx::h1
            :color="$title_color ?? 'text-blue-800' "
            :text="$title" 
        />
    @endif
    @if (! empty($subtitle))
        <x-lavx::h2
            :color="$subtitle_color ?? 'text-green-800' "
            :text="$subtitle"
        />
    @endif
    @if (! empty($return_link))
        <x-lavx::button
            :link="$return_link"
            :color="$return_color ?? 'green' "
            :text="$return_text ?? __('lavx::sys.back') "
            :external="$return_external ?? false"
        />
    @endif
    @if (! empty($alert))
        <x-lavx::alert
            :color="$alert_color ?? '' "
            :text="$alert"
            :escaped="$alert_escaped ?? false"
        />
    @endif
    @if (! empty($button_link))
        <x-lavx::button
            :link="$button_link"
            :color="$button_color ?? '' "
            :text="$button_text ?? __('lavx::sys.back') "
            :external="$button_external ?? false"
        />
    @endif
</x-lavx::layout.page>