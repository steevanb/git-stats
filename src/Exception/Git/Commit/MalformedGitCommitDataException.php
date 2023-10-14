<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Exception\Git\Commit;

use Steevanb\GitStats\{
    Exception\GitStatsException,
    Git\Commit\CommitId
};
use Steevanb\PhpCollection\ScalarCollection\StringCollection;

class MalformedGitCommitDataException extends GitStatsException
{
    public function __construct(CommitId $id, StringCollection $data)
    {
        parent::__construct('Malformed git commit data for #' . $id->getId() . ': ' . implode("\n", $data->toArray()));
    }
}
