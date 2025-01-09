<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PostalCode;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    public function index(Request $request)
    {
        $query = PostalCode::query();

        if ($request->has('postal_code') && !empty($request->postal_code)) {
            $postalCode = str_replace(' ', '', $request->postal_code);
            $query->whereRaw("REPLACE(postal_code, ' ', '') LIKE ?", ["$postalCode%"]);
        }
        if ($request->has('country') && !empty($request->country)) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }
        if ($request->has('state') && !empty($request->state)) {
            $query->where('province', 'like', '%' . $request->state . '%');
        }
        if ($request->has('city') && !empty($request->city)) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        if ($request->has('time_zone') && !empty($request->time_zone)) {
            $query->where('time_zone', 'like', '%' . $request->time_zone . '%');
        }

        $locations = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $locations,
        ]);
    }
}
