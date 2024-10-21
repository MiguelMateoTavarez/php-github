<?php

namespace App\Controllers;
use App\Services\GithubServiceInterface;

class GithubController
{
    private $githubService;

    public function __construct(
        GithubServiceInterface $githubService
    )
    {
        $this->githubService = $githubService;
    }

    public function search(string $query)
    {
        return $this->githubService->searchRepositories($query);
    }
}