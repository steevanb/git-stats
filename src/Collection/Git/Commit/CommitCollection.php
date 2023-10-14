<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Collection\Git\Commit;

use Steevanb\GitStats\Git\Commit\Commit;
use Steevanb\PhpCollection\{
    ObjectCollection\AbstractObjectCollection,
    ObjectCollection\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

class CommitCollection extends AbstractObjectCollection
{
    public function __construct(iterable $values = [])
    {
        parent::__construct(Commit::class, $values, ComparisonModeEnum::HASH, ValueAlreadyExistsModeEnum::DO_NOT_ADD);
    }

    public function add(Commit $commit): static
    {
        return $this->doAdd($commit);
    }
}
