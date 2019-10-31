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
     * Service météo adaptatif
     * @return array
     */
    public function getWeather($longitude, $latitude)
    {
        header('Content-Type: application/json'); 
        // J'interroge l'api Darksky via file_get_contents
        $url = file_get_contents('https://api.darksky.net/forecast/' . $this->apiKey . '/' . $latitude . ',' . $longitude .'?lang=fr&units=auto');
        // decodage du résultat via json_decodey
        $jsonData = (json_decode($url)); 

        return $jsonData; 
    }


    /**
     * Service météo Toulouse
     * @return array
     */
    public function getToulouseWeather($longitude, $latitude)
    {
        header('Content-Type: application/json'); 

        $url = file_get_contents('https://api.darksky.net/forecast/' . $this->apiKey . '/' . $latitude . ',' . $longitude .'?lang=fr&units=auto'); 
        $jsonData = (json_decode($url)); 

        return $jsonData; 
    }


}
