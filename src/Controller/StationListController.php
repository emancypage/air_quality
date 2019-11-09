<?php


namespace App\Controller;


use App\Service\AirQualityRestApi;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StationListController extends AbstractController
{
    /**
     * @Route("/station-list", name="station_list")
     */
    public function index(AirQualityRestApi $airQualityRestApi)
    {
        return $this->render('air_quality/index.html.twig', [
            'stationList' => $airQualityRestApi->getStationList()
        ]);
    }
}