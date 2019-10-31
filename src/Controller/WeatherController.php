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
     * @Route("/", name="meteo", methods={"POST"})
     */
    public function meteo(Request $request, WeatherService $weatherService)
    {
        $longitude = $request->request->get('longitude');
        $latitude = $request->request->get('latitude');
        $city = $request->request->get('city-name');

        $cityMeteo = $weatherService->getWeather($longitude, $latitude);


        $latitudeTls = 43.5689; 
        $longitudeTls = 1.39069;
        $meteoToulouse = $weatherService->getToulouseWeather($longitudeTls, $latitudeTls);

            // dump($meteoo);exit;
        return $this->render('weather/index.html.twig', [
            'cityMeteo' => $cityMeteo,
            'city' => $city,
            'meteo' => $meteoToulouse,
            'ville' => 'Toulouse'
        ]);


    }


     /**
     * @Route("/", name="weather")
     */
    public function index(Request $request, WeatherService $weatherService)
    {
        // toulouse
        $latitudeTls = 43.5689; 
        $longitudeTls = 1.39069;
        $meteoToulouse = $weatherService->getToulouseWeather($longitudeTls, $latitudeTls);

        return $this->render('weather/index.html.twig', [
            'meteo' => $meteoToulouse,
            'ville' => 'Toulouse'
        ]);

    }

}
