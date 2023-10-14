<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Collection\Git\Commit;

use Steevanb\GitStats\Git\Commit\CommitId;
use Steevanb\PhpCollection\{
    ObjectCollection\AbstractObjectCollection,
    ObjectCollection\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

class CommitIdCollection extends AbstractObjectCollection
{
    public function __construct(iterable $values = [])
    {
        parent::__construct(CommitId::class, $values, ComparisonModeEnum::HASH, ValueAlreadyExistsModeEnum::DO_NOT_ADD);
    }

    public function add(CommitId $id): static
    {
        return $this->doAdd($id);
    }
}
