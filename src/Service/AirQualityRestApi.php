<?php


namespace App\Service;


use Symfony\Component\HttpClient\HttpClient;


class AirQualityRestApi
{

    /**
     * @param string $stationId
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getStationIndex(string $stationId): array
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://api.gios.gov.pl/pjp-api/rest/aqindex/getIndex/'.$stationId);

        $stationIndex = $response->toArray();

        return $stationIndex;
    }

    /**
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getStationList(): array
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://api.gios.gov.pl/pjp-api/rest/station/findAll');

        $stationList = $response->toArray();
        $stationList = $this->convertNullableValues($stationList);

        return $stationList;
    }

    /**
     * @param array $arrayToProcess
     * @return array
     */
    private function convertNullableValues(array $arrayToProcess): array
    {
        foreach ($arrayToProcess as $key => $value) {
            if (is_null($value)) {
                $arrayToProcess[$key] = '';
            }

            if (is_array($value)) {
                $value = $this->convertNullableValues($value);

                $arrayToProcess[$key] = $value;
            }
        }

        return $arrayToProcess;
    }
}