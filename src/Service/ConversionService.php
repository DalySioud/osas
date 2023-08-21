<?php
// src/Service/ConversionService.php

// src/Service/ConversionService.php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class ConversionService
{
    private $apiBaseUrl = 'https://v6.exchangerate-api.com/v6/';
    private $apiKey; // Your API access code

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getDollarToDinarConversionRate(): float
    {
        $client = HttpClient::create();
        $url = $this->apiBaseUrl . $this->apiKey . '/pair/USD/TND';
        $response = $client->request('GET', $url);

        $data = $response->toArray();
        $conversionRate = $data['conversion_rate'] ?? 1.0; // Default to 1 if the rate is not available

        return (float) $conversionRate;
    }
}

?>