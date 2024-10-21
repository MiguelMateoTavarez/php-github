<?php

namespace App\Services;
use GuzzleHttp\Client;

class GithubService implements GithubServiceInterface
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.github.com/',
            'verify' => false,  // Desactiva la verificación SSL
        ]);
    }

    public function searchRepositories(string $query): array
    {
        $response = $this->client->request('GET', 'search/repositories', [
            'query' => ['q' => $query]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        return $data['items'] ?? [];
    }
}