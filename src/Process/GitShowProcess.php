<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Process;

use Steevanb\GitStats\Git\Commit\CommitDataPrefixEnum;

class GitShowProcess extends Process
{
    public function __construct(string $repositoryPath, string $id)
    {
        $format =
            CommitDataPrefixEnum::DATE->value . ' %aD%n'
            . CommitDataPrefixEnum::AUTHOR_NAME->value . '%aN%n'
            . CommitDataPrefixEnum::AUTHOR_EMAIL->value . '%ae';

        parent::__construct(['git', 'show', '--no-patch', '--format="' . $format, $id], $repositoryPath);
    }
}
