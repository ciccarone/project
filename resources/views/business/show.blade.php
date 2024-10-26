<!-- resources/views/business/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $business->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <div class="col-span-2 flex mb-4 lg:mb-0">
                            @if($business->logo_image)
                                <img src="{{ asset('storage/' . $business->logo_image) }}" alt="Logo" class="w-16 h-16 mr-4 rounded-full">
                            @endif
                            <div>
                                <h3 class="text-lg font-bold">{{ $business->name }}</h3>
                                @if($business->user)
                                    <p><strong>Owner:</strong> {{ $business->user->name }}</p>
                                @endif
                                @if($business->website_url)
                                    <p><a href="{{ $business->website_url }}" target="_BLANK" class="text-blue-500">Visit Website</a></p>
                                @endif
                                <p><strong>Address:</strong> {{ $business->address }}</p>
                                <div>
                        @if($business->services->isNotEmpty())
                            <h4 class="font-semibold">Services:</h4>
                            <ul class="flex flex-wrap gap-2">
                                @foreach($business->services as $service)
                                    <li class="bg-blue-100 text-blue-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                        {{ $service->name }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                            </div>

                        </div>
                        <div class="lg:ml-4 lg:mt-0 mt-4">
                        @if(request()->has('ref'))
                                <h4 class="font-semibold">Contact {{ $business->name }}</h4>
                                <form action="{{ route('referrals.store') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="ref" value="{{ request('ref') }}">
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}" required>
                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" required>
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                                        <textarea name="message" id="message" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" rows="4" required>{{ old('message', Auth::check() ? "{$business->user->name}, this is a referral from " . Auth::user()->name . ":" : '') }}</textarea>
                                        @error('message')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        {!! NoCaptcha::display() !!}
                                        @error('g-recaptcha-response')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Submit</button>
                                </form>
                                {!! NoCaptcha::renderJs() !!}
                            @else
                                <h4 class="font-semibold">Referral QR Code:</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                    Scan QR or <a href="{{ $url }}">click here</a> to contact {{ $business->name }} directly
                                </p>

                                {!! $qrCodeDataUri !!}
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
