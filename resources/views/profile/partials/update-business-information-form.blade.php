<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Business Profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Remember to keep your business information up-to-date!") }}
        </p>
    </header>

    <!-- Display existing businesses -->
    @if($user && $user->businesses && $user->businesses->isNotEmpty())
        <div class="mt-6 space-y-6">
            <form action="{{ route('businesses.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    @foreach($user->businesses as $index => $business)
                        <div class="p-4 border rounded-lg mb-4">
                            <div class="accordion-header cursor-pointer" onclick="toggleAccordion({{ $index }})">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $business->name }}</h3>
                            </div>
                            <div id="accordion-content-{{ $index }}" class="accordion-content {{ $index === 0 ? 'block' : 'hidden' }}">
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $business->description }}</p>

                                <!-- Display the current logo image -->
                                @if($business->logo_image)
                                    <div class="mt-4">
                                        <img src="{{ asset('storage/' . $business->logo_image) }}" alt="Logo Image" class="w-64 object-cover">
                                    </div>
                                @endif
                                <div class="mt-4">
                                    <x-input-label for="logo_image-{{ $business->id }}" :value="__('Update Logo Image')" />
                                    <input id="logo_image-{{ $business->id }}" name="logo_image[{{ $business->id }}]" type="file" class="mt-1 block w-full" />
                                    <x-input-error class="mt-2" :messages="$errors->get('logo_image')" />
                                </div>

                                <!-- Address Input -->
                                <label for="address-{{ $business->id }}" class="block text-sm font-medium text-gray-700 mt-3 dark:text-gray-300">Address</label>
                                <input type="text" id="address-{{ $business->id }}" name="address[{{ $business->id }}]" value="{{ $business->address }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

                                <!-- Website URL Input -->
                                <label for="website_url-{{ $business->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-3">Website URL</label>
                                <input type="url" id="website_url-{{ $business->id }}" name="website_url[{{ $business->id }}]" value="{{ $business->website_url }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

                                <label for="services-{{ $business->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-3">Services</label>
                                <select id="services-{{ $business->id }}" name="services[{{ $business->id }}][]" class="services-select" multiple="multiple" style="width: 100%">
                                    @foreach($allServices as $service)
                                        <option value="{{ $service->id }}" {{ in_array($service->id, $business->services->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Description Input -->
                                <label for="description-{{ $business->id }}" class="block text-sm font-medium text-gray-700 mt-3 dark:text-gray-300">Description / Keywords</label>
                                <textarea id="description-{{ $business->id }}" name="description[{{ $business->id }}]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Enter keywords or a description so {{ $business->name }} can be found">{{ $business->description ?? '' }}</textarea>

                                <!-- Social Profiles -->
                                <label for="social_profiles-{{ $business->id }}" class="mt-3 block text-sm font-medium text-gray-700 dark:text-gray-300">Social Profiles</label>
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

                                <div class="flex justify-between mt-4">
                                    <button type="button" onclick="addSocialProfile({{ $business->id }})" class="px-4 py-2 bg-green-500 text-white rounded">Add Another Social Profile</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <script>
                        function toggleAccordion(index) {
                            const content = document.getElementById(`accordion-content-${index}`);
                            content.classList.toggle('hidden');
                            content.classList.toggle('block');
                        }
                    </script>

            </form>
        </div>
    @else
        <!-- Form for adding a new business -->
        <div class="mt-6 space-y-6">
            <form action="{{ route('business.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="p-4 border rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('New Business') }}</h3>

                    <div class="mt-4">
                        <x-input-label for="new_logo_image" :value="__('Add Logo Image')" />
                        <input id="new_logo_image" name="logo_image" type="file" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('logo_image')" />
                    </div>

                    <!-- Name Input -->
                    <div class="form-group">
                        <label for="business_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Business Name</label>
                        <input type="text" id="business_name" name="business_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <!-- Address Input -->
                    <label for="new_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                    <input type="text" id="new_address" name="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

                    <!-- Website URL Input -->
                    <label for="new_website_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Website URL</label>
                    <input type="url" id="new_website_url" name="website_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

                    <label for="new_services" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Services</label>
                    <select id="new_services" name="services[]" class="services-select" multiple="multiple" style="width: 100%">
                        @foreach($allServices as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>

                    <!-- Description Input -->
                    <label for="new_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description / Keywords</label>
                    <textarea id="new_description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Enter keywords or description so the business can be found"></textarea>

                    <!-- Social Profiles -->
                    <label for="new_social_profiles" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Social Profiles</label>
                    <div id="new_social_profiles_container">
                        <div class="flex items-center space-x-2 mt-2">
                            <select name="social_profiles[network][]" class="block w-1/3 rounded-md border-gray-300 shadow-sm">
                                <option value="facebook">Facebook</option>
                                <option value="twitter">Twitter</option>
                                <option value="linkedin">LinkedIn</option>
                                <option value="instagram">Instagram</option>
                                <option value="youtube">YouTube</option>
                                <option value="tiktok">TikTok</option>
                                <option value="github">GitHub</option>
                                <!-- Add more social networks as needed -->
                            </select>
                            <input type="url" name="social_profiles[url][]" class="block w-2/3 rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>
                    <button type="button" onclick="addNewSocialProfile()" class="mt-2 px-4 py-2 bg-green-500 text-white rounded">Add Social Profile</button>
                </div>

                <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </form>
        </div>
    @endif
</section>

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

    function addNewSocialProfile() {
        const container = document.getElementById('new_social_profiles_container');
        const div = document.createElement('div');
        div.classList.add('flex', 'items-center', 'space-x-2', 'mt-2');
        div.innerHTML = `
            <select name="social_profiles[network][]" class="block w-1/3 rounded-md border-gray-300 shadow-sm">
                <option value="facebook">Facebook</option>
                <option value="twitter">Twitter</option>
                <option value="linkedin">LinkedIn</option>
                <option value="instagram">Instagram</option>
                <option value="youtube">YouTube</option>
                <option value="tiktok">TikTok</option>
                <option value="github">GitHub</option>
                <!-- Add more social networks as needed -->
            </select>
            <input type="url" name="social_profiles[url][]" class="block w-2/3 rounded-md border-gray-300 shadow-sm">
        `;
        container.appendChild(div);
    }
</script>
