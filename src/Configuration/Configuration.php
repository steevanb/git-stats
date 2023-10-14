<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Configuration;

class Configuration
{
    protected string $repositoryPath = '/app';

    public function __construct()
    {
    }

    public function setRepositoryPath(string $repositoryPath): static
    {
        $this->repositoryPath = $repositoryPath;

        return $this;
    }

    public function getRepositoryPath(): string
    {
        return $this->repositoryPath;
    }
}
