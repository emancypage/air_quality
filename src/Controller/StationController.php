<?php

namespace App\Controller;

use App\Entity\Station;
use App\Repository\StationRepository;
use App\Service\AirQualityRestApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StationController extends AbstractController
{
    /**
     * @Route("/station/{stationId}", name="station_detail")
     */
    public function index(
        AirQualityRestApi $airQualityRestApi,
        StationRepository $stationRepository,
        string $stationId
    )
    {
        $station = $stationRepository->findOneByApiStationId($stationId);

        return $this->render('air_quality/station_detail.html.twig', [
            'station' => $station
        ]);
    }
}
