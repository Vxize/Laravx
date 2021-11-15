<x-lavx::layout.page margin="mx-auto mt-6" :width="$width ?? 'max-w-lg' ">
    @if (isset($title['text']) && $title['text'])
        <x-lavx::h1
            :color="$title['color'] ?? 'text-blue-800' "
            :text="$title['text']" 
        />
    @endif
    @if (isset($subtitle['text']) && $subtitle['text'])
        <x-lavx::h2
            :color="$subtitle['color'] ?? 'text-green-800' "
            :text="$subtitle['text']" 
        />
    @endif
    @if (isset($return_button['link']) && $return_button['link'])
        <x-lavx::button
            :link="$return_button['link']"
            :color="$return_button['color'] ?? 'green' "
            :text="$return_button['text'] ?? __('lavx::sys.back') "
            :external="$return_button['external'] ?? false"
        />
    @endif
    @if (isset($alert['text']) && $alert['text'])
        <x-lavx::alert
            :color="$alert['color'] ?? '' "
            :text="$alert['text']"
            :escaped="$alert['escaped'] ?? false"
        />
    @endif
    @if (isset($button['link']) && $button['link'])
        <x-lavx::button
            :link="$button['link']"
            :color="$button['color'] ?? '' "
            :text="$button['text'] ?? __('lavx::sys.back') "
            :external="$button['external'] ?? false"
        />
    @endif
</x-lavx::layout.page>