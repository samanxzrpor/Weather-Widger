<?php
namespace App\Services;

use App\Utilities\CurlHandler;



class WeatherAPI
{
    private const API_KEY = 'dc8d10d71e9ea30b8559708cbcd4056b';

    private const UNIT = 'metric';

    private const LANG = 'en';

    public $city ;



    public function getCityWeather(string $city)
    {
        $url = "api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".self::API_KEY."&units=".self::UNIT."";
        
        $currentData = CurlHandler::sendGet($url);
        
        if (json_decode($currentData)->cod == 404)
            throw new \Exception("No weather data available");

        return $currentData;
    }

    public function getWeeklyWeather(string $city)
    {
        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=33.44&lon=-94.04&exclude=hourly,daily&appid=".self::API_KEY."&units=".self::UNIT."";
        
        $currentData = CurlHandler::sendGet($url);
        print_r($currentData);
        exit;

        if (json_decode($currentData)->cod == 404)
            throw new \Exception("No weather data available");

        return $currentData;
    }



}