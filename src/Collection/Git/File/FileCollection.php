<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Collection\Git\File;

use Steevanb\GitStats\Git\File\File;
use Steevanb\PhpCollection\{
    ObjectCollection\AbstractObjectCollection,
    ObjectCollection\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

class FileCollection extends AbstractObjectCollection
{
    public function __construct(iterable $values = [])
    {
        parent::__construct(File::class, $values, ComparisonModeEnum::HASH, ValueAlreadyExistsModeEnum::DO_NOT_ADD);
    }

    public function add(File $file): static
    {
        return $this->doAdd($file);
    }

    /** @return array<File> */
    public function toArray(): array
    {
        /** @var array<File> $return */
        $return = parent::toArray();

        return $return;
    }
}
