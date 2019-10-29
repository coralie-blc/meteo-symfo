<?php

namespace App\Controller;

use App\Form\CityType;
use App\Service\WeatherService;
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
     * @Route("/weather", name="weather")
     */
    public function index(WeatherService $wheatherService)
    {
        $form = $this->createForm(CityType::class);

        $meteo = 'https://api.darksky.net/forecast/78dada84a9acde5d1c922d09eb67744d/43.5689,1.39069?lang=fr&units=auto';

        $str = file_get_contents($meteo);
        $json = json_decode($str, true);
        // dump($json);exit;
        return $this->render('weather/index.html.twig', array(
            'form' => $form->createView(),
            'meteo' => $json,
        ));
    }


}
