<x-lavx::layout.page margin="mx-auto mt-6" :width="$width ?? 'max-w-lg' ">
    <x-lavx::h1
        :color="$title_color ?? 'text-red-600' "
        :text="$title ?? __('lavx::sys.error') "
    />
    @if (isset($subtitle) && $subtitle)
        <x-lavx::h2
            :color="$subtitle_color ?? 'text-green-800' "
            :text="$subtitle"
        />
    @endif
    @if (isset($return_link) && $return_link)
        <x-lavx::button
            :link="$return_link"
            :color="$return_color ?? 'green' "
            :text="$return_text ?? __('lavx::sys.back') "
            :external="$return_external ?? false"
        />
    @endif
    <x-lavx::alert
        :color="$alert_color ?? 'red' "
        :text="$alert ?? __('lavx::sys.return_retry') "
        :escaped="$alert_escaped ?? false"
    />
    @if (isset($button_link) && $button_link)
        <x-lavx::button
            :link="$button_link"
            :color="$button_color ?? '' "
            :text="$button_text ?? __('lavx::sys.back') "
            :external="$button_external ?? false"
        />
    @endif
</x-lavx::layout.page>