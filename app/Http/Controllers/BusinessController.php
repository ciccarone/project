<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;

class BusinessController extends Controller
{
    public function getBusinessNames(Request $request)
    {
        $term = $request->input('term');
        $businessNames = Business::where('name', 'LIKE', '%' . $term . '%')->pluck('name');
        return response()->json($businessNames);
    }
}
