<?php

namespace App\Controller;

use App\Repository\StationRepository;
use App\Service\ApiSync;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StationController extends AbstractController
{
    /**
     * @Route("/station/{stationId}", name="station_detail")
     */
    public function index(
        ApiSync $apiSync,
        StationRepository $stationRepository,
        string $stationId
    )
    {
        $apiSync->syncStationData($stationId);
        $station = $stationRepository->findOneByApiStationId($stationId);

        return $this->render('air_quality/station_detail.html.twig', [
            'station' => $station
        ]);
    }
}
