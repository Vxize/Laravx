<x-lavx::layout.page margin="mx-auto mt-12">
    <x-lavx::h1 text="{{ __('lavx::user.verify_email') }}" />
    
    @if (session('status') == 'verification-link-sent')
        <x-lavx::form.status status="{{ __('lavx::user.verification_link_sent') }}" />
    @else
        <x-lavx::alert color="red">
            {{ __('lavx::user.verification_link_sent') }}。{{ __('lavx::user.verify_email_helper', ['search' => config('app.name')]) }}
        </x-lavx::alert>
    @endif

    <div class="mt-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-lavx::form.submit 
                    text="{{ __('lavx::user.resend_verification_email') }}"
                    icon="reply"
                />
            </div>
        </form>
    </div>
    <div class="mt-4 text-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-blue-600 hover:text-blue-300">
                {{ __('lavx::user.logout') }}
            </button>
        </form>
    </div>
</x-lavx::layout.page>