<?php

namespace App\Services;


class GeolocationService
{
    /**
     * Get linear distance in kilometers between two coordinates
     *
     * @param  float $lat1
     * @param  float $lng1
     * @param  float $lat2
     * @param  float $lng2
     * @return float $distance_km
     */
    public function getLinearDistance(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earth_radius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));
        $distance_km = $earth_radius * $c;

        return $distance_km;
    }
}
