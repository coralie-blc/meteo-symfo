<?php

namespace App\Controller;

use App\Form\CityType;
use App\Service\WeatherService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeatherController extends AbstractController
{
    private $wheatherService;

    public function __construct(WeatherService $weather)
    {
        $this->weatherService = $weather;
    }



    
    /**
     * @Route("/meteo", name="meteo", methods={"POST"})
     */
    public function meteo(Request $request, WeatherService $weatherService)
    {
        $longitude = $request->request->get('longitude');
        $latitude = $request->request->get('latitude');
        $city = $request->request->get('city-name');
        dump($city);

        dump($longitude);

        $cityMeteo = $weatherService->getWeather($longitude, $latitude);
            // dump($meteoo);exit;
        return $this->render('weather/index.html.twig', array(
            'cityMeteo' => $cityMeteo,
            'city' => $city
        ));


    }


     /**
     * @Route("/", name="weather")
     */
    public function index(Request $request, WeatherService $weatherService)
    {
        // toulouse
        $meteo = file_get_contents('https://api.darksky.net/forecast/78dada84a9acde5d1c922d09eb67744d/43.5689,1.39069?lang=fr&units=auto');

        $jsonData = (json_decode($meteo));
        return $this->render('weather/index.html.twig', array(
            'meteo' => $jsonData,
            'city' => 'Toulouse'
        ));

    }

}
