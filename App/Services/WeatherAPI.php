<?php
namespace App\Services;

use App\Utilities\CurlHandler;
use App\Services\Location;


class WeatherAPI
{
    private const API_KEY = 'YOUR-API'; # IN https://christianflach.de/OpenWeatherMap-PHP-API/

    private const UNIT = 'metric';

    private const LANG = 'en';



    public function getCityWeather(string $city)
    {
        $url = "api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".self::API_KEY."&units=".self::UNIT."";
        
        $currentData = CurlHandler::curlGetRequest($url);
        
        if (json_decode($currentData)->cod == 404)
            throw new \Exception("No weather data available");

        return $currentData;
    }

    public function getWeeklyWeather(string $city)
    {
        $locationService = new Location();
        $locationData = $locationService->getLatLong($city);

        $url = "https://api.openweathermap.org/data/2.5/onecall?lat={$locationData['latitude']}&lon=-{$locationData['longitude']}&exclude=current&appid=".self::API_KEY."&units=".self::UNIT."";
        
        $dailyWeather = json_decode( CurlHandler::curlGetRequest($url))->daily;

        return $dailyWeather;
    }

}