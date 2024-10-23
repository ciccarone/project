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
                            <label for="query" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Search</label>
                            <input type="text" id="query" name="query" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Search by business name, service, or user name">
                        </div>
                        <div class="form-group mb-4">
                            <label for="services" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Services</label>
                            <select id="services" name="services[]" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" multiple>
                                @foreach($allServices as $service)
                                    <option value="{{ $service->name }}">{{ $service->name }}</option>
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
                        <p class="mb-4">Showing {{ $businesses->count() }} of {{ $allMatchingBusinessesCount }} businesses that match your search criteria.</p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($businesses as $business)
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                                    <div class="flex items-center mb-4">
                                        @if($business->logo_image)
                                            <img src="{{ asset('storage/' . $business->logo_image) }}" alt="Logo" class="w-16 h-16 mr-4 rounded-full">
                                        @endif
                                        <div>
                                            <h3 class="text-lg font-bold">{{ $business->name }}</h3>
                                            <p><strong>Owner:</strong> {{ $business->user->name }}</p>
                                            <p><strong>Website:</strong> <a href="{{ $business->website_url }}" class="text-blue-500">{{ $business->website_url }}</a></p>
                                            <p><strong>Address:</strong> {{ $business->address }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Services:</h4>
                                        <ul class="flex flex-wrap gap-2">
                                            @foreach($business->services as $service)
                                                <li class="bg-blue-100 text-blue-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                                    {{ $service->name }}
                                                </li>
                                            @endforeach
                                        </ul>
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
