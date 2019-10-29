<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

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
    public function getWeather()
    {
        $city = '43.5689,1.39069';
        $response = $this->client->request('GET', 'https://api.darksky.net/forecast/' . $this->apiKey . '/' . $city .'?exclude=minutly,flags');

        $url = 'https://api.darksky.net/forecast/78dada84a9acde5d1c922d09eb67744d/43.5689,1.39069?exclude=minutly,flags';
        dump($url);

        return [
            'response' => $url,
            'temperature' => '20', // en °C
            'vent' => '17', // en km/H
        ];
    }
}
