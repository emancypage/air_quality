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

    public function __construct(
        AirQualityRestApi $airQualityRestApi,
        EntityManagerInterface $entityManager
    )
    {
        $this->airQualityRestApi = $airQualityRestApi;
        $this->entityManager = $entityManager;
        $this->communeRepository = $entityManager->getRepository(Commune::class);
        $this->cityRepository = $entityManager->getRepository(City::class);
    }

    public function sync()
    {
        $stationList = $this->airQualityRestApi->getStationList();

        foreach ($stationList as $stationData) {

            if (!is_array($stationData['city'])) {
                continue;
            }

            $communeName = $stationData['city']['commune']['communeName'];
            $districtName = $stationData['city']['commune']['districtName'];
            $provinceName = $stationData['city']['commune']['provinceName'];

            $commune = $this->communeRepository->getOneByFields($communeName, $districtName, $provinceName);

            if (!$commune) {
                $commune = new Commune();
                $commune->setCommuneName($communeName)
                    ->setDistrictName($districtName)
                    ->setProvinceName($provinceName);
            }

            $city = new City();
            $city->setApiCityId($stationData['city']['id'])
                ->setName($stationData['city']['name'])
                ->setCommune($commune);

            $station = new Station();
            $station->setApiStationId($stationData['id'])
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