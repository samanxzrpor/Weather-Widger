<?php
namespace App\Controllers;

use App\Services\WeatherAPI;
use App\Utilities\FormValidateion;


class Weather
{

    private $weather ;


    public function __construct()
    {
        $this->weather = new WeatherAPI();
    }

    public function getCurrentWeather(string $city )
    {

        $weatherData = json_decode($this->weather->getCityWeather($city));
        
        $icon = $this->setIcon($weatherData->weather[0]->main);

        $retenedData = [
            'tempData' => $weatherData->main ,
            'windSpeed' => intval($weatherData->wind->speed * 3.6) ,
            'cloud' => $weatherData->clouds->all,
            'country' => $weatherData->sys->country,
            'city' => $weatherData->name ,
            'dis' => $weatherData->weather[0]->main,
            'icon' => $icon
        ];
        
        return $retenedData;
    }

    public function get4DayWeather(string $city)
    {
        $returnedData = [];

        $weeklyWeather = $this->weather->getWeeklyWeather($city);

        for ($i=1; $i < 5; $i++) { 

            $icon = $this->setIcon($weeklyWeather[$i]->weather[0]->main);

            $retenedData[$i] = [
                'temp' => $weeklyWeather[$i]->temp->day ,
                'dayName' => date('D' , $weeklyWeather[$i]->dt) ,
                'icon' => $icon
            ];
        }
        
        return $retenedData;
    }

    public function setIcon(string $status)
    {
        
        if ($status == 'Clouds')
            $icon = 'cloud';

        if ($status == 'Rain')
            $icon = 'cloud-rain';

        if ($status == 'Snow')
            $icon = 'cloud-snow';

        if ($status == 'Clear')
            $icon = 'sun';
        
            return $icon;
    }

}