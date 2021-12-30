<?php
namespace App\Controllers;

use App\Controllers\Weather;
use App\Utilities\FormValidateion;
use App\Utilities\XSSClean;
use App\Utilities\Date;
use App\Models\City;


class Home
{
    private $city = 'Tehran';


    public function index(array $getParams = [])
    {
        $weather = new Weather();

        if (isset($_POST['location']))
            $this->city = FormValidateion::validatePostString($_POST['location']);

        if (isset($getParams) && !empty($getParams))
            $this->city = XSSClean::xss_clean($getParams['loc']);
        
        $dailyWeather = $weather->get4DayWeather($this->city);
        $weatherData = $weather->getCurrentWeather($this->city);

        $date = Date::getDate();
        
        loadView('index' , ['weatherData' => $weatherData , 'date' => $date , 'dailyWeather' =>$dailyWeather]);
    }


    public function getSearched()
    {
        $cities = new City();
        $searched_word = FormValidateion::validatePostString($_POST['location']);
        $result = (array)$cities->get(['city' => $searched_word] , []);

        $count = count($result) <= 3 ? count($result) : 3;
        for ($i=0; $i < $count; $i++) { 
            echo "<a href='".getUrl('location/'.$result[$i])."'><span id='searched'>".$result[$i]."</span></a><br><br>";
        }
    }
    


}