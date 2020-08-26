<?php


namespace App\Service;


use App\Service\Interfaces\WorksProviderInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpClient\HttpClient;

class WorksProvider implements WorksProviderInterface
{

    public function __construct()
    {
    }

    public function toArray()
    {
        $httpClient = HttpClient::create();
        try {
            $response = $httpClient->request('GET', 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa');
        } catch (\Exception $e) {
            return $e;
        }
        $responseArray = [];
        foreach ($response->toArray() as $value) {
            $responseArray[] = [
                'title' => $value['id'],
                'level' => $value['zorluk'],
                'estimated_duration' => $value['sure'],
                'required_load' => $value['sure'] * $value['zorluk']
            ];
        }

        usort($responseArray, function ($item1, $item2) {
            return $item2['required_load'] <=> $item1['required_load'];
        });

        return $responseArray;
    }
}