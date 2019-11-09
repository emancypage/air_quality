<?php

namespace App\Controller;

use App\Service\AirQualityRestApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StationController extends AbstractController
{
    /**
     * @Route("/station/{id}", name="station_detail")
     */
    public function index(AirQualityRestApi $airQualityRestApi, string $id)
    {
        return $this->render('air_quality/index.html.twig', [
            'qualityStatus' => $airQualityRestApi->getCurrentStatus($id)
        ]);
    }
}
