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
     * @Route("/city", name="select-city")
     */
    public function citySelect(Request $request)
    {
        if($request->getMethod() == 'POST') {
            // Si c'est le cas, on récupére les données du formulaire
            $city = $request->request->get('city');
            // dump($city);exit;
            // On redirige l'utilisateur vers la page de l'article
            return $this->redirectToRoute('index');
        }

    }


    /**
     * @Route("/weather", name="weather")
     */
    public function index(WeatherService $wheatherService)
    {
        $form = $this->createForm(CityType::class);

        $url = 'https://api.darksky.net/forecast/78dada84a9acde5d1c922d09eb67744d/43.5689,1.39069?lang=fr&units=auto';

        $str = file_get_contents($url);
        $meteo = json_decode($str, true);
        // dump($json);exit;
        return $this->render('weather/index.html.twig', array(
            'form' => $form->createView(),
            'meteo' => $meteo,
        ));
    }


}
