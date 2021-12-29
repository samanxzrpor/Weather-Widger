<?php
namespace App\Controllers;

use App\Controllers\Weather;
use App\Utilities\FormValidateion;
use App\Utilities\XSSClean;
use App\Models\City;


class Home
{

    public function index(array $getParams = [])
    {
        $city = 'piranshahr';
        $weather = new Weather();

        if (isset($_POST['location']))
            $city = FormValidateion::validatePostString($_POST['location']);

        if (isset($getParams) && !empty($getParams))
            $city = XSSClean::xss_clean($getParams['loc']);
        
        // $weatherData = $weather->get4DayWeather($city);
        
        $weatherData = $weather->getCurrentWeather($city);
        $date = $weather->getDate();
        
        loadView('index' , ['weatherData' => $weatherData , 'date' => $date]);
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