<div class="mt-4">
    <x-filament::button
        :href="route('socialite.redirect', 'google')"
        tag="a"
        color=""
        class="w-full -mt-4 !bg-white hover:!bg-gray-100 !text-gray-900 border border-gray-300"
    >
    <img src="{{ asset('icons/google.png') }}" class="h-5 w-5" alt="google">
        <span class="ml-2">Sign in with Google</span>
    </x-filament::button>
</div>
