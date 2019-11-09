<?php

namespace App\Controller;

use App\Service\AirQualityRestApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AirQualityController extends AbstractController
{
    /**
     * @Route("/airquality", name="air_quality")
     */
    public function index(AirQualityRestApi $airQualityRestApi)
    {
        return $this->render('air_quality/index.html.twig', [
            'qualityStatus' => $airQualityRestApi->getCurrentStatus('114')
        ]);
    }
}
