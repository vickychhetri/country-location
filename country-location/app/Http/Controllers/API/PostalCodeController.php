<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PostalCode;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    /**
     * Display a filtered list of postal codes based on query parameters.
     *
     * This method retrieves postal code records from the database
     * by applying filters provided in the request. The filters include:
     * - `postal_code`: Partial or complete postal code to search for.
     * - `country_code`: Country code to match.
     * - `admin_name1`: Name of the first administrative division (e.g., state).
     * - `admin_name2`: Name of the second administrative division (e.g., county/province).
     * - `accuracy`: Accuracy level of the location data.
     *
     * Query Parameters:
     * - `postal_code` (string): Searches for postal codes after removing spaces and performing a partial match.
     * - `country_code` (string): Performs a case-insensitive partial match on the country code.
     * - `admin_name1` (string): Performs a case-insensitive partial match on the first administrative division.
     * - `admin_name2` (string): Performs a case-insensitive partial match on the second administrative division.
     * - `accuracy` (string): Matches locations with a specific accuracy level.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing query parameters.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the filtered list of postal codes.
     *
     * Example Request:
     * GET /api/postal-codes?postal_code=4216&country_code=IN&admin_name1=Maharashtra
     *
     * Example Response:
     * {
     *   "status": "success",
     *   "data": [
     *     {
     *       "id": 1,
     *       "country_code": "IN",
     *       "postal_code": "421605",
     *       "place_name": "Phalegaon",
     *       "admin_name1": "Maharashtra",
     *       "admin_name2": "Thane",
     *       "latitude": 19.36,
     *       "longitude": 73.3279,
     *       "accuracy": 4
     *     }
     *   ]
     * }
     */
    public function index(Request $request)
    {
        $query = PostalCode::query();

        if ($request->has('postal_code') && !empty($request->postal_code)) {
            $postalCode = str_replace(' ', '', $request->postal_code);
            $query->whereRaw("REPLACE(postal_code, ' ', '') LIKE ?", ["$postalCode%"]);
        }
        if ($request->has('country_code') && !empty($request->country_code)) {
            $query->where('country_code', 'like', '%' . $request->country_code . '%');
        }
        if ($request->has('admin_name1') && !empty($request->admin_name1)) {
            $query->where('admin_name1', 'like', '%' . $request->admin_name1 . '%');
        }
        if ($request->has('admin_name2') && !empty($request->admin_name2)) {
            $query->where('admin_name2', 'like', '%' . $request->admin_name2 . '%');
        }
        if ($request->has('accuracy') && !empty($request->time_zone)) {
            $query->where('accuracy', 'like', '%' . $request->time_zone . '%');
        }

        $locations = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $locations,
        ]);
    }


    /**
     * GET /api/postal-codes/{postalCode}

     * Get the details of a specific postal code.
     *
     * @param string $postalCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($postalCode)
    {
        $postalCode = PostalCode::where('postal_code', $postalCode)->get();

        if (!$postalCode) {
            return response()->json([
                'status' => 'error',
                'message' => 'Postal code not found.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $postalCode,
        ]);
    }


    /**
     * GET /api/postal-codes/nearby?latitude=19.36&longitude=73.32&radius=15

     * Get nearby locations based on latitude and longitude.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function nearby(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'numeric|min:1|max:50', // Default radius is 10 km
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = $request->radius ?? 10;

        $locations = PostalCode::nearby($latitude, $longitude, $radius)->get();

        return response()->json([
            'status' => 'success',
            'data' => $locations,
        ]);
    }

}
