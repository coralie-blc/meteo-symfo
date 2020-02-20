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



// Test 
function additionner($a, $b)
{
  if (!is_numeric($a) || !is_numeric($b))
  {
    // On lance une nouvelle exception grâce à throw et on instancie directement un objet de la classe Exception.
    throw new Exception('Les deux paramètres doivent être des nombres');
  }
  
  return $a + $b;
}

}
