<?php

namespace App\Traits;

trait DetectsUserEnvironment
{
    public static function detectDevice(): string
    {
        $agent = request()->header('User-Agent');

        if (str_contains($agent, 'Mobile')) {
            return 'Mobile';
        } elseif (str_contains($agent, 'Tablet')) {
            return 'Tablet';
        }

        return 'Desktop';
    }

    public static function detectIP(): string
    {
        $ipAddress = request()->ip();

        return $ipAddress === '::1' ? '127.0.0.1' : $ipAddress;
    }

    public static function detectOS(): string
    {
        $agent = request()->header('User-Agent');

        return match (true) {
            str_contains($agent, 'Windows') => 'Windows',
            str_contains($agent, 'Mac') => 'MacOS',
            str_contains($agent, 'Linux') => 'Linux',
            str_contains($agent, 'Android') => 'Android',
            str_contains($agent, 'iPhone'), str_contains($agent, 'iPad') => 'iOS',
            default => 'Unknown',
        };
    }

    public static function detectBrowser(): string
    {
        $agent = request()->header('User-Agent');

        return match (true) {
            str_contains($agent, 'Chrome') => 'Chrome',
            str_contains($agent, 'Firefox') => 'Firefox',
            str_contains($agent, 'Safari') && !str_contains($agent, 'Chrome') => 'Safari',
            str_contains($agent, 'Edge') => 'Edge',
            str_contains($agent, 'MSIE'), str_contains($agent, 'Trident') => 'Internet Explorer',
            default => 'Unknown',
        };
    }
    public static function detectClientFullDetails()
    {
        $ipAddress = DetectsUserEnvironment::detectIP() ?? '';
        // $ipAddress = '217.165.73.244';
        $geoApiUrl = "http://ip-api.com/php/$ipAddress?fields=61439";

        $geoResponse = file_get_contents($geoApiUrl);
        $geoData = unserialize($geoResponse);  // Use unserialize for PHP serialized response

        return $geoData;
    }
}
