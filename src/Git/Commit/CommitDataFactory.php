<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\Commit;

use Steevanb\GitStats\Exception\Git\Commit\MalformedGitCommitDataException;
use Steevanb\PhpCollection\ScalarCollection\StringCollection;

class CommitDataFactory
{
    public static function create(CommitId $id, StringCollection $data): CommitData
    {
        if ($data->count() !== 3) {
            throw new MalformedGitCommitDataException($id, $data);
        }
        if (str_starts_with($data->get(0), CommitDataPrefixEnum::DATE->value) === false) {
            throw new MalformedGitCommitDataException($id, $data);
        }
        if (str_starts_with($data->get(1), CommitDataPrefixEnum::AUTHOR_NAME->value) === false) {
            throw new MalformedGitCommitDataException($id, $data);
        }
        if (str_starts_with($data->get(2), CommitDataPrefixEnum::AUTHOR_EMAIL->value) === false) {
            throw new MalformedGitCommitDataException($id, $data);
        }

        return new CommitData(
            new \DateTimeImmutable(substr($data->get(0), strlen(CommitDataPrefixEnum::DATE->value))),
            substr($data->get(1), strlen(CommitDataPrefixEnum::AUTHOR_NAME->value)),
            substr($data->get(2), strlen(CommitDataPrefixEnum::AUTHOR_EMAIL->value))
        );
    }
}
