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
                    <div class="flex items-center mb-4">
                        @if($business->logo_image)
                            <img src="{{ asset('storage/' . $business->logo_image) }}" alt="Logo" class="w-16 h-16 mr-4 rounded-full">
                        @endif
                        <div>
                            <h3 class="text-lg font-bold">{{ $business->name }}</h3>
                            @if($business->user)
                                <p><strong>Owner:</strong> {{ $business->user->name }}</p>
                            @endif
                            @if($business->website_url)
                                <p><a href="{{ $business->website_url }}"   target="_BLANK" class="text-blue-500">Visit Website</a></p>
                            @endif
                            <p><strong>Address:</strong> {{ $business->address }}</p>
                        </div>
                    </div>
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
        </div>
    </div>
</x-app-layout>
