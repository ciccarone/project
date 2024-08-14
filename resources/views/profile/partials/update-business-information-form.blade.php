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
        <form action="{{ route('businesses.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @foreach($user->businesses as $business)
        <div class="p-4 border rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $business->name }}</h3>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $business->description }}</p>

            <!-- Display the current logo image -->
            @if($business->logo_image)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $business->logo_image) }}" alt="Logo Image" class="w-64 object-cover">
                </div>
            @endif
            <div class="mt-4">
                <x-input-label for="logo_image" :value="__('Logo Image')" />
                <input id="logo_image" name="logo_image" type="file" class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('logo_image')" />
            </div>

            <!-- Address Input -->
            <label for="address-{{ $business->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
            <input type="text" id="address-{{ $business->id }}" name="address[{{ $business->id }}]" value="{{ $business->address }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

            <!-- Website URL Input -->
            <label for="website_url-{{ $business->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Website URL</label>
            <input type="url" id="website_url-{{ $business->id }}" name="website_url[{{ $business->id }}]" value="{{ $business->website_url }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

            <label for="services-{{ $business->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Services</label>
            <select id="services-{{ $business->id }}" name="services[{{ $business->id }}][]" class="services-select" multiple="multiple" style="width: 100%">
                @foreach($allServices as $service)
                    <option value="{{ $service->id }}" {{ in_array($service->id, $business->services->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>

            <!-- Social Profiles -->
            <label for="social_profiles-{{ $business->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Social Profiles</label>
            <div id="social_profiles_container-{{ $business->id }}">
            @foreach(json_decode($business->social_profiles, true) as $network => $url)
                    <div class="flex items-center space-x-2 mt-2">
                        <select name="social_profiles[{{ $business->id }}][network][]" class="block w-1/3 rounded-md border-gray-300 shadow-sm">
                            <option value="facebook" {{ $network == 'facebook' ? 'selected' : '' }}>Facebook</option>
                            <option value="twitter" {{ $network == 'twitter' ? 'selected' : '' }}>Twitter</option>
                            <option value="linkedin" {{ $network == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                            <option value="instagram" {{ $network == 'instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="youtube" {{ $network == 'youtube' ? 'selected' : '' }}>YouTube</option>
                            <option value="tiktok" {{ $network == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                            <option value="github" {{ $network == 'github' ? 'selected' : '' }}>GitHub</option>
                            <!-- Add more social networks as needed -->
                        </select>
                        <input type="url" name="social_profiles[{{ $business->id }}][url][]" value="{{ $url }}" class="block w-2/3 rounded-md border-gray-300 shadow-sm">
                    </div>
                @endforeach
            </div>
            <script>
                function addSocialProfile(businessId) {
                    const container = document.getElementById(`social_profiles_container-${businessId}`);
                    const div = document.createElement('div');
                    div.classList.add('flex', 'items-center', 'space-x-2', 'mt-2');
                    div.innerHTML = `
                        <select name="social_profiles[${businessId}][network][]" class="block w-1/3 rounded-md border-gray-300 shadow-sm">
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="instagram">Instagram</option>
                            <option value="youtube">YouTube</option>
                            <option value="tiktok">TikTok</option>
                            <option value="github">GitHub</option>
                            <!-- Add more social networks as needed -->
                        </select>
                        <input type="url" name="social_profiles[${businessId}][url][]" class="block w-2/3 rounded-md border-gray-300 shadow-sm">
                    `;
                    container.appendChild(div);
                }
            </script>
            </div>
            <button type="button" onclick="addSocialProfile({{ $business->id }})" class="mt-2 px-4 py-2 bg-green-500 text-white rounded">Add Social Profile</button>
        </div>
    @endforeach

    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Save</button></form>
        </div>

    @endif



</section>
