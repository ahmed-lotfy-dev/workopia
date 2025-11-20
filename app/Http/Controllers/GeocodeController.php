<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeocodeController extends Controller
{
    public function geocode(Request $request): array
    {

        $address = $request->input('address');
        $accessToken = env('MAPTILER_KEY');

        $response = Http::get("https://api.maptiler.com/geocoding/{$address}.json", [
            'key' => $accessToken,
        ])->throw();

        return $response->json();

    }
}