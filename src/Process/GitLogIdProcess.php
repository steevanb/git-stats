<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Process;

class GitLogIdProcess extends Process
{
    public function __construct(string $repositoryPath)
    {
        parent::__construct(['git', 'log', '--pretty=format:"%H"'], $repositoryPath);
    }
}
