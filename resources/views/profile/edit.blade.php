<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="py-12">

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                @php
                    $user = Auth::user();
                    $userMeta = $user->userMeta;
                    $chambers = App\Models\Chamber::all();
                    $chamberId = $userMeta->chamber_id; // Assuming $userMeta is available and contains the selected chamber ID
                    $groups = App\Models\Group::where('chamber_id', $chamberId)->get();

                    $allServices = App\Models\Service::all();
                @endphp
                @include('profile.partials.update-business-information-form', ['user' => $user, 'userMeta' => $userMeta, 'chambers' => $chambers, 'allServices' => $allServices])
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                @php
                    $user = Auth::user();
                    $userMeta = $user->userMeta;
                    $chambers = App\Models\Chamber::all();
                    $chamberId = $userMeta->chamber_id; // Assuming $userMeta is available and contains the selected chamber ID
                    $groups = App\Models\Group::where('chamber_id', $chamberId)->get();

                @endphp
                @include('profile.partials.update-profile-information-form', ['user' => $user, 'userMeta' => $userMeta, 'chambers' => $chambers])
                </div>
            </div>



            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
