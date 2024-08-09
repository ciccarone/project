<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Business Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your business information.") }}
        </p>
    </header>

    <!-- Display existing businesses -->
    @if($user && $user->businesses && $user->businesses->isNotEmpty())

        <div class="mt-6 space-y-6">
        <form action="{{ route('businesses.update') }}" method="POST">
    @csrf
    @method('PUT')

    @foreach($user->businesses as $business)
        <div class="p-4 border rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $business->name }}</h3>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $business->description }}</p>

            <label for="services-{{ $business->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Services</label>
            <select id="services-{{ $business->id }}" name="services[{{ $business->id }}][]" class="services-select" multiple="multiple" style="width: 100%">
                @foreach($allServices as $service)
                    <option value="{{ $service->id }}" {{ in_array($service->id, $business->services->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @endforeach

    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Save Services</button></form>
        </div>

    @endif



</section>
