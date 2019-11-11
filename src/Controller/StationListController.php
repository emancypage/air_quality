<?php


namespace App\Controller;


use App\Service\AirQualityRestApi;
use App\Service\ApiSync;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StationListController extends AbstractController
{
    /**
     * @Route("/station-list", name="station_list")
     */
    public function index(
        AirQualityRestApi $airQualityRestApi,
        ApiSync $apiSync,
        Request $request
    )
    {
        $form = $this->createFormBuilder()
            ->add('sync', SubmitType::class, ['label' => 'Sync'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $apiSync->syncStationList();
        }

        return $this->render('air_quality/station_list.html.twig', [
            'stationList' => $airQualityRestApi->getStationList(),
            'form' => $form->createView()
        ]);
    }
}