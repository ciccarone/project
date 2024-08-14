<?php
// app/Http/Controllers/BusinessController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use Illuminate\Support\Facades\Storage;


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
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

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
                if ($request->hasFile('logo_image')) {
                    // Ensure the directory exists
                    if (!Storage::disk('public')->exists('logo_images')) {
                        Storage::disk('public')->makeDirectory('logo_images');
                    }

                    // Store the uploaded file
                    $imagePath = $request->file('logo_image')->store('logo_images', 'public');
                    $business->logo_image = $imagePath;
                }

                $business->save();
            }
        }

        return redirect()->back()->with('success', 'Services updated successfully.');
    }

<?php
public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
        'website_url' => 'nullable|url|max:255',
        'services' => 'array',
        'services.*' => 'exists:services,id',
        'social_profiles' => 'array',
        'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Create a new business instance
    $business = new Business();
    $business->name = $validatedData['name'];
    $business->address = $validatedData['address'];
    $business->user_id = $validatedData['user_id'];
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
    return redirect()->route('business.index')->with('success', 'Business created successfully.');
}
}
