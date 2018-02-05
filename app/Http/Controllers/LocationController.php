<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use App\Services\LocationService;

class LocationController extends Controller
{
    /**
     * LocationController constructor.
     *
     * @param LocationService $locationService
     */
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    /**
     * Get locations tree format.
     */
    public function getLocations($location)
    {
        $country = Country::where(['acronym' => $location])->first();

        if (!$country) {
            return response()->json(['message' => 'The state not found'], 404);
        }

        $locations =  $this->locationService->createTreeLocation($country);

        return response()->json(['message' => 'successfully', 'data' => $locations], 200);


    }
}
