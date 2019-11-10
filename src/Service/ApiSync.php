<?php


namespace App\Service;



use App\Entity\City;
use App\Entity\Commune;
use App\Entity\Station;
use App\Repository\CityRepository;
use App\Repository\CommuneRepository;
use Doctrine\ORM\EntityManagerInterface;

class ApiSync
{
    /**
     * @var AirQualityRestApi
     */
    private $airQualityRestApi;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var CommuneRepository
     */
    private $communeRepository;
    /**
     * @var CityRepository
     */
    private $cityRepository;
    /**
     * @var \App\Repository\StationRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private $stationRepository;

    public function __construct(
        AirQualityRestApi $airQualityRestApi,
        EntityManagerInterface $entityManager
    )
    {
        $this->airQualityRestApi = $airQualityRestApi;
        $this->entityManager = $entityManager;
        $this->communeRepository = $entityManager->getRepository(Commune::class);
        $this->cityRepository = $entityManager->getRepository(City::class);
        $this->stationRepository = $entityManager->getRepository(Station::class);
    }

    public function syncStationList()
    {
        $stationList = $this->airQualityRestApi->getStationList();

        foreach ($stationList as $stationData) {

            if (!is_array($stationData['city'])) {
                continue;
            }

            $apiStationId = $stationData['id'];
            $cityId = $stationData['city']['id'];
            $communeName = $stationData['city']['commune']['communeName'];
            $districtName = $stationData['city']['commune']['districtName'];
            $provinceName = $stationData['city']['commune']['provinceName'];

            $city = $this->cityRepository->findOneByApiCityId($cityId);
            $station = $this->stationRepository->findOneByApiStationId($apiStationId);
            $commune = $this->communeRepository->getOneByFields($communeName, $districtName, $provinceName);

            if (!$commune) {
                $commune = new Commune();
                $commune->setCommuneName($communeName)
                    ->setDistrictName($districtName)
                    ->setProvinceName($provinceName);
            }

            if (!$city) {
                $city = new City();
                $city->setApiCityId($cityId)
                    ->setName($stationData['city']['name'])
                    ->setCommune($commune);
            }

            if (!$station) {
                $station = new Station();
                $station->setApiStationId($apiStationId)
                    ->setStationName($stationData['stationName'])
                    ->setGegrLat($stationData['gegrLat'])
                    ->setGegrLon($stationData['gegrLon'])
                    ->setCity($city)
                    ->setAddressStreet($stationData['addressStreet']);

                $this->entityManager->persist($commune);
                $this->entityManager->persist($city);
                $this->entityManager->persist($station);

                $this->entityManager->flush();
            }
        }
    }
}