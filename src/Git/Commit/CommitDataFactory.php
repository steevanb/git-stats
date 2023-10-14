<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\Commit;

use Steevanb\GitStats\{
    Exception\Git\Commit\MalformedGitCommitDataException,
    Process\GitShowProcess
};

class CommitDataFactory
{
    public static function create(string $repositoryPath, string $id): CommitData
    {
        $lines = (new GitShowProcess($repositoryPath, $id))->mustRun()->getOutputLines();

        if ($lines->count() !== 3) {
            throw new MalformedGitCommitDataException($id, $lines);
        }
        if (str_starts_with($lines->get(0), CommitDataPrefixEnum::DATE->value) === false) {
            throw new MalformedGitCommitDataException($id, $lines);
        }
        if (str_starts_with($lines->get(1), CommitDataPrefixEnum::AUTHOR_NAME->value) === false) {
            throw new MalformedGitCommitDataException($id, $lines);
        }
        if (str_starts_with($lines->get(2), CommitDataPrefixEnum::AUTHOR_EMAIL->value) === false) {
            throw new MalformedGitCommitDataException($id, $lines);
        }

        return new CommitData(
            new \DateTimeImmutable(substr($lines->get(0), strlen(CommitDataPrefixEnum::DATE->value))),
            substr($lines->get(1), strlen(CommitDataPrefixEnum::AUTHOR_NAME->value)),
            substr($lines->get(2), strlen(CommitDataPrefixEnum::AUTHOR_EMAIL->value))
        );
    }
}
