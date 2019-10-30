<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WeatherService
{
    private $client;
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->client = HttpClient::create();
        $this->apiKey = $apiKey;
    }


    /**
     * @return array
     */
    public function getWeather($longitude, $latitude)
    {
        header('Content-Type: application/json'); 

        // $city = '43.5689,1.39069';
        // $response = $this->client->request('GET', 'https://api.darksky.net/forecast/' . $this->apiKey . '/' . $latitude . $longitude .'?lang=fr&units=auto');

        // $url = file_get_contents('https://api.darksky.net/forecast/78dada84a9acde5d1c922d09eb67744d/43.5689,1.39069?lang=fr&units=auto');
        $url = file_get_contents('https://api.darksky.net/forecast/' . $this->apiKey . '/' . $latitude . ',' . $longitude .'?lang=fr&units=auto');

        
        $jsonData = (json_decode($url)); 
        // dump($jsonData);



        return $jsonData; 
    }

}
