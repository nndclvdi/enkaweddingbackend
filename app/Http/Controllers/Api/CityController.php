<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::withCount('weddingPackages')->get();
        return CityResource::collection($cities);
    }

    public function show(City $city) // model binding
    {
        $city->load(['weddingPackages.city', 'weddingPackages.photos']);
        $city->loadCount('weddingPackages');
        return new CityResource($city);
    }
}
