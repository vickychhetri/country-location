<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    use HasFactory;

    protected $table = "postal_codes";

    protected $fillable = [
        'country_code',
        'postal_code',
        'place_name',
        'admin_name1',
        'admin_code1',
        'admin_name2',
        'admin_code2',
        'admin_name3',
        'admin_code3',
        'latitude',
        'longitude',
        'accuracy'
    ];

    /**
     * Get full address as a formatted string.
     *
     * @return string
     */
    public function getFullAddress(): string
    {
        $parts = array_filter([
            $this->place_name,
            $this->admin_name3,
            $this->admin_name2,
            $this->admin_name1,
            $this->country_code
        ]);

        return implode(', ', $parts);
    }

    /**
     * Scope a query to filter postal codes by proximity.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  float $latitude
     * @param  float $longitude
     * @param  float $radius
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNearby($query, float $latitude, float $longitude, float $radius = 10)
    {
        $haversine = "(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude))))";
        return $query->selectRaw("{$haversine} AS distance", [$latitude, $longitude, $latitude])
            ->having('distance', '<=', $radius)
            ->orderBy('distance', 'asc');
    }

    /**
     * Get location details as an array.
     *
     * @return array
     */
    public function getLocationDetails(): array
    {
        return [
            'country' => $this->country_code,
            'state' => $this->admin_name1,
            'county' => $this->admin_name2,
            'city' => $this->place_name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }

    /**
     * Get human-readable accuracy level.
     *
     * @return string
     */
    public function getAccuracyLevel(): string
    {
        $levels = [
            1 => 'Estimated',
            4 => 'GeoName ID',
            6 => 'Centroid of Addresses or Shape'
        ];

        return $levels[$this->accuracy] ?? 'Unknown';
    }
}
