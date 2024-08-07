<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <x-input-label for="chamber" :value="__('Chamber')" />
    <form action="{{ route('profile.updateChamber') }}" method="POST">
        @csrf
        <select id="chamber" name="chamber" class="mt-1 block w-full" onchange="this.form.submit()" {{ Auth::id() !== 1 ? 'disabled' : '' }}>
            @foreach($chambers as $chamber)
                <option value="{{ $chamber->id }}" {{ $userMeta->chamber_id == $chamber->id ? 'selected' : '' }}>
                    {{ $chamber->name }}
                </option>
            @endforeach
        </select>
    </form>
    <x-input-error class="mt-2" :messages="$errors->get('chamber')" />

    <x-input-label for="group" :value="__('Group')" />
    <form action="{{ route('profile.updateGroup') }}" method="POST">
        @csrf
        <select id="group" name="group" class="mt-1 block w-full" onchange="this.form.submit()" {{ Auth::id() !== 1 ? 'disabled' : '' }}>
            @foreach($groups as $group)
                <option value="{{ $group->id }}" {{ $userMeta->group_id == $group->id ? 'selected' : '' }}>
                    {{ $group->name }}
                </option>
            @endforeach
        </select>
    </form>
    <x-input-error class="mt-2" :messages="$errors->get('group')" />

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Display the user's business information -->
        @if($userMeta->business_id)
            <div class="mt-4">
                <x-input-label for="business" :value="__('Business')" />
                <input id="business" name="business" type="text" class="mt-1 block w-full" value="{{ $userMeta->business->name }}" />
            </div>
        @endif

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<!-- Include jQuery for simplicity -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include jQuery UI for autocomplete -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Include custom JavaScript file -->
<script src="{{ asset('js/autocomplete.js') }}"></script>
