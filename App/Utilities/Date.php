<?php
namespace App\Utilities;


class Date 
{

    private static $fullDate;

    private static $dayName;
    

    public static function setDate()
    {
        self::$fullDate = date('Y M d');
        
        self::$dayName = date('l');

    }

    public static function getDate()
    {
        self::setDate();

        return ['day'=>self::$dayName , 'fullDate'=>self::$fullDate];
    }

}