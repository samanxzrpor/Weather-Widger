<?php
namespace App\Controllers;

use App\Services\WeatherAPI;
use App\Utilities\FormValidateion;


class Weather
{
    private $weather ;

    private $fullDate;

    private $dayName;

    private $icon;

    private $weatherData = [];

    private $weeklyWeather = [];

    public function __construct()
    {
        $this->weather = new WeatherAPI();
    }

    public function setDate()
    {
        $this->fullDate = date('Y M d');
        
        $this->dayName = date('l');

    }

    public function getDate()
    {
        $this->setDate();

        return ['day'=>$this->dayName , 'fullDate'=>$this->fullDate];
    }

    public function getCurrentWeather(string $city )
    {

        $this->weatherData = json_decode($this->weather->getCityWeather($city));
        
        $this->setIcon();

        $retenedData = [
            'tempData' => $this->weatherData->main ,
            'windSpeed' => intval($this->weatherData->wind->speed * 3.6) ,
            'cloud' => $this->weatherData->clouds->all,
            'country' => $this->weatherData->sys->country,
            'city' =>$this->weatherData->name ,
            'dis' => $this->weatherData->weather[0]->main,
            'icon' => $this->icon
        ];
        
        return $retenedData;
    }

    public function get4DayWeather(string $city)
    {
        $this->weeklyWeather = json_decode($this->weather->getWeeklyWeather($city));

    }

    public function setIcon()
    {
        $iconDis = $this->weatherData->weather[0]->main;
        
        if ($iconDis == 'Clouds')
            $this->icon = 'cloud';

        if ($iconDis == 'Rain')
            $this->icon = 'cloud-rain';

        if ($iconDis == 'Rain')
            $this->icon = 'cloud-snow';

        if ($iconDis == 'Clear')
            $this->icon = 'sun';
        
    }

}