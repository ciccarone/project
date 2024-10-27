<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chamber Hub') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <!-- Sidebar -->
                <div class="w-1/4 bg-gray-200 dark:bg-gray-700 p-4">
                <ul>
                    <li><strong>Name:</strong> {{ $user->name }}</li>
                    <li><strong>Email:</strong> {{ $user->email }}</li>
                    @if($userMeta)
                    @php
                        $roles = config('app.roles');
                    @endphp
                    <li><strong>Role:</strong> {{ $roles[$userMeta->role_id] }}</li>
                    @endif

                </ul>
                </div>
                <!-- Main Content -->
                <div class="w-3/4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h2 class="text-xl font-semibold mb-4">Referrals</h2>
        @foreach(Auth::user()->businesses as $business)
            <h3 class="text-lg font-semibold">{{ $business->name }}</h3>
            @foreach($business->referrals as $referral)
                <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded">
                    <p><strong>Name:</strong> {{ $referral->name }}</p>
                    <p><strong>Email:</strong> {{ $referral->email }}</p>
                    <p><strong>Message:</strong> {{ $referral->message }}</p>
                    <p><strong>Qualified:</strong> {{ $referral->qualified ? 'Yes' : 'No' }}</p>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
            </div>
        </div>
    </div>
</x-app-layout>
