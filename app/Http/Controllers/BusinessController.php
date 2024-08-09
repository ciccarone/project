<?php
// app/Http/Controllers/BusinessController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;

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

    public function store(Request $request)
    {
        // Validate and store the business
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'website_url' => 'nullable|url',
            'social_profiles' => 'nullable|json',
        ]);

        Business::create($validatedData);

        return redirect()->route('business.index')->with('success', 'Business created successfully.');
    }
}
