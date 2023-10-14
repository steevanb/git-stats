<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Process;

class DiffStatProcess extends Process
{
    public static function create(string $repositoryPath, string $commitId): static
    {
        return static::fromShellCommandline(
            'git show --format= ' . $commitId . ' | diffstat -m',
            $repositoryPath
        );
    }
}
