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
}
