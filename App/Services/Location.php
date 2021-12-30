<?php
namespace App\Services;

use App\Utilities\CurlHandler;



class Location
{
    private const API_KEY = 'YOUR-API'; # IN https://ipstack.com/

    public function getLatLong(string $address)
    {
        $queryString = http_build_query([
            'access_key' => self::API_KEY,
            'query' => $address,
          ]);
          
          $ch = curl_init(sprintf('%s?%s', 'http://api.positionstack.com/v1/forward', $queryString));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          
          $json = curl_exec($ch);
          
          curl_close($ch);
          
          $apiResult = json_decode($json, true);
          
          return $apiResult['data'][0];
    }



}