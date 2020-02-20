<?php

namespace App\Controller;

use App\Service\WeatherService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeatherController extends AbstractController
{

    public function __construct(WeatherService $weather)
    {
        $this->weatherService = $weather;
    }



    
    /**
     * @Route("/meteo", name="meteo", methods={"GET"})
     */
    public function meteo(Request $request, WeatherService $weatherService)
    {
        // Récupération des données du formulaire avec request / input hidden 
        // Données se remplissant automatiquement avec app.js
        // J'ai fait le choix d'une méthode GET pour obtenir une url partageable.
        // On parle ici de météo, pas de formulaire "sécurité" ou POST sera indispensable
        $longitude = $request->query->get('longitude');
        $latitude = $request->query->get('latitude');
        $city = $request->query->get('city-name');

        // appel au WeatherService et passage des données $longitude $latitude dynamiquement.
        $cityMeteo = $weatherService->getWeather($latitude, $longitude);

        // Puisqu'on rappelle le même template (index.html.twig), je redonne les données concernant Toulouse
        $latitudeTls = 43.5689; 
        $longitudeTls = 1.39069;
        $meteoToulouse = $weatherService->getWeather($longitudeTls, $latitudeTls);

            // dump($meteoo);exit;
        return $this->render('weather/index.html.twig', [
            'cityMeteo' => $cityMeteo,
            'city' => $city,
            'meteo' => $meteoToulouse,
            'ville' => 'Toulouse'
        ]);


    }


     /**
     * @Route("/", name="home")
     */
    public function index(Request $request, WeatherService $weatherService)
    {
        // Données de Toulouse
        $latitudeTls = 43.5689; 
        $longitudeTls = 1.39069;
        $meteoToulouse = $weatherService->getWeather($longitudeTls, $latitudeTls);

        return $this->render('weather/index.html.twig', [
            'meteo' => $meteoToulouse,
            'ville' => 'Toulouse'
        ]);

    }

}
