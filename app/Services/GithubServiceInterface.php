<?php

namespace App\Services;

interface GithubServiceInterface
{
    public function searchRepositories(string $query): array;
}