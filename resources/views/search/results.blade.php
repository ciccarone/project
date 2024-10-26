<!-- resources/views/search/results.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">Search</h1>
                    <form action="{{ route('search') }}" method="GET" class="mb-4">
                        <div class="form-group mb-4">
                            <label for="query" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keyword</label>
                            <input type="text" id="query" name="query" class="text-black form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Search by business name, keyword, or user" value="{{ request('query') }}">
                        </div>
                        <div class="form-group mb-4">
                            <label for="services" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Services</label>
                            <select id="services" name="services[]" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" multiple>
                                @foreach($allServices as $service)
                                    <option value="{{ $service->name }}" {{ in_array($service->name, request('services', [])) ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="sort" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sort By</label>
                            <select id="sort" name="sort" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black">
                                <option value="alphabetically" {{ $sortOption === 'alphabetically' ? 'selected' : '' }}>Alphabetically</option>
                                <option value="recently_updated" {{ $sortOption === 'recently_updated' ? 'selected' : '' }}>Recently Updated</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded">Search</button>
                    </form>

                    <!-- Displaying the search results -->
                    @if(isset($businesses))
                        <h2 class="text-xl font-semibold mb-4">Business Results</h2>
                        <p class="mb-4">
                            @php
                                $searchPerformed = request()->has('query') && request()->input('query') !== '';
                            @endphp

                            @if($searchPerformed)
                                @if($businesses->count() === 1)
                                    Showing 1 business that matches your search criteria.
                                @else
                                    Showing {{ $businesses->count() }} businesses that match your search criteria.
                                @endif
                            @else
                                @if($businesses->count() === 1)
                                    Showing 1 business.
                                @else
                                    Showing {{ $businesses->count() }} businesses.
                                @endif
                            @endif
                            @if(($allMatchingBusinessesCount - $businesses->count()) > 0)
                                <span class="ml-2">
                                    <svg class="w-5 h-5 inline-block text-gray-500 cursor-pointer" data-tippy-content="There are {{ $allMatchingBusinessesCount - $businesses->count() }} businesses part of other chambers that you cannot access." xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18.5a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                    </svg>
                                </span>
                            @endif
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($businesses as $business)
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                                    <div class="flex items-center mb-4">
                                        @if($business->logo_image)
                                            <img src="{{ asset('storage/' . $business->logo_image) }}" alt="Logo" class="w-16 h-16 mr-4 rounded-full">
                                        @else
                                            <div class="w-16 h-16 mr-4 rounded-full bg-gray-300 flex items-center justify-center text-white text-2xl font-bold">
                                                {{ strtoupper(substr($business->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="text-lg font-bold">{{ $business->name }}</h3>
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
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
