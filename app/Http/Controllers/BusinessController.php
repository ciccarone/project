<?php
// app/Http/Controllers/BusinessController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Purifier;


class BusinessController extends Controller
{
    public function getBusinessNames(Request $request)
    {
        $term = $request->get('term');
        $businesses = Business::where('name', 'LIKE', '%' . $term . '%')->get();

        // Format the data for jQuery UI Autocomplete
        $formattedBusinesses = $businesses->map(function ($business) {
            return [
                'label' => $business->name,
                'value' => $business->name,
            ];
        });

        return response()->json($formattedBusinesses);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $allServices = Service::all();

        return view('update-business-information-form', compact('user', 'allServices'));
    }



    public function update(Request $request)
    {

    $data = $request->validate([
        'address' => 'array',
        'website_url' => 'array',
        'services' => 'array',
        'services.*' => 'array',
        'services.*.*' => 'exists:services,id',
        'social_profiles' => 'array',
        'logo_image' => 'array',
        'logo_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description' => 'array',
        'description.*' => 'nullable|string',
    ]);

    // Process each business
    foreach ($data['description'] as $businessId => $description) {
        $business = Business::findOrFail($businessId);

        // Sanitize the description if it exists
        $description = isset($description) ? $description : null;

        $business->update([
            'description' => $description,
        ]);
    }

    // Check if 'services' key exists in the validated data
    if (isset($data['services'])) {
        foreach ($data['services'] as $businessId => $serviceIds) {
            $business = Business::findOrFail($businessId);

            // Check if $serviceIds is empty
            if (empty($serviceIds)) {
                $business->services()->sync([]);
            } else {
                $business->services()->sync($serviceIds);
            }
        }
    }

        foreach ($data['address'] as $businessId => $address) {
            $business = Business::find($businessId);
            if ($business) {
                $business->address = $address;
                $business->website_url = $data['website_url'][$businessId] ?? null;
                $business->services()->sync($data['services'][$businessId] ?? []);

                // Handle social profiles
                $socialProfiles = [];
                if (isset($data['social_profiles'][$businessId])) {
                    foreach ($data['social_profiles'][$businessId]['network'] as $index => $network) {
                        $url = $data['social_profiles'][$businessId]['url'][$index] ?? '';
                        if ($network && $url) {
                            $socialProfiles[$network] = $url;
                        }
                    }
                }
                $business->social_profiles = json_encode($socialProfiles);

                // Handle logo image upload
                if ($request->hasFile("logo_image.$businessId")) {
                    // Ensure the directory exists
                    if (!Storage::disk('public')->exists('logo_images')) {
                        Storage::disk('public')->makeDirectory('logo_images');
                    }

                    // Store the uploaded file
                    $imagePath = $request->file("logo_image.$businessId")->store('logo_images', 'public');
                    $business->logo_image = $imagePath;
                }

                $business->save();
            }
        }

        return redirect()->back()->with('success', 'Services updated successfully.');
    }


    public function store(Request $request)
    {

        // Validate the request data
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'website_url' => 'nullable|url|max:255',
            'services' => 'array',
            'services.*' => 'exists:services,id',
            'social_profiles' => 'array',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'array',
            'description.*' => 'nullable|string',
        ]);

        $data['description'] = isset($data['description']) ? Purifier::clean($data['description']) : null;




        // Create a new business instance
        $business = new Business();
        $business->name = $validatedData['business_name'];
        $business->address = $validatedData['address'];
        $business->user_id = auth()->id(); // Assign the authenticated user's ID
        $business->website_url = $validatedData['website_url'] ?? null;

        // Handle logo image upload
        if ($request->hasFile('logo_image')) {
            $imagePath = $request->file('logo_image')->store('logo_images', 'public');
            $business->logo_image = $imagePath;
        }

        // Handle social profiles
        $socialProfiles = [];
        if (isset($validatedData['social_profiles'])) {
            foreach ($validatedData['social_profiles']['network'] as $index => $network) {
                $url = $validatedData['social_profiles']['url'][$index] ?? '';
                if ($network && $url) {
                    $socialProfiles[$network] = $url;
                }
            }
        }
        $business->social_profiles = json_encode($socialProfiles);

        // Save the business
        $business->save();

        // Sync services
        if (isset($validatedData['services'])) {
            $business->services()->sync($validatedData['services']);
        }

        // Redirect with success message
        return redirect()->back()->with('success', 'Services updated successfully.');
    }

    public function search(Request $request)
    {
        // Fetch all services
        $allServices = Service::all();

        // Get the search query, selected services, and sorting option
        $query = $request->input('query');
        $selectedServices = $request->input('services', []);
        $sortOption = $request->input('sort', 'alphabetically');

        // Get the authenticated user's chamber ID from user_metas
        $chamberId = Auth::check() ? Auth::user()->userMeta->chamber_id : 0;


        // Perform the search logic
        $businesses = Business::query();

        if ($query) {
            $businesses->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhereHas('user', function ($q) use ($query) {
                      $q->where('name', 'like', '%' . $query . '%');
                  });
            });
        }

        if (!empty($selectedServices)) {
            $businesses->whereHas('services', function ($q) use ($selectedServices) {
                $q->whereIn('name', $selectedServices);
            });
        }

        // Apply sorting
        if ($sortOption === 'recently_updated') {
            $businesses->orderBy('updated_at', 'desc');
        } else {
            $businesses->orderBy('name', 'asc');
        }

        // Count all matching businesses without chamber restriction
        $allMatchingBusinessesCount = $businesses->count();

        // Restrict to businesses from users in the same chamber
        $businesses->whereHas('user.userMeta', function ($q) use ($chamberId) {
            $q->where('chamber_id', $chamberId);
        });

        $businesses = $businesses->get();
        $users = User::where('name', 'like', '%' . $query . '%')->get();
        $servicesResult = Service::whereIn('name', $selectedServices)->get();

        return view('search.results', compact('allServices', 'businesses', 'users', 'servicesResult', 'sortOption', 'allMatchingBusinessesCount'));
    }

    public function show($id)
    {
        $business = Business::with('user', 'services')->findOrFail($id);
        return view('business.show', compact('business'));
    }
}
