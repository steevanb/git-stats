<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Exception\Git\Commit;

use Steevanb\GitStats\Exception\GitStatsException;
use Steevanb\PhpCollection\ScalarCollection\StringCollection;

class MalformedGitCommitDataException extends GitStatsException
{
    public function __construct(string $commitId, StringCollection $data)
    {
        parent::__construct('Malformed git commit data for #' . $commitId . ': ' . implode("\n", $data->toArray()));
    }
}
