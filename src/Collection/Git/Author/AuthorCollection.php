<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Collection\Git\Author;

use Steevanb\GitStats\Git\Author\Author;
use Steevanb\PhpCollection\{
    ObjectCollection\AbstractObjectCollection,
    ObjectCollection\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

class AuthorCollection extends AbstractObjectCollection
{
    public function __construct(iterable $values = [])
    {
        parent::__construct(Author::class, $values, ComparisonModeEnum::HASH, ValueAlreadyExistsModeEnum::DO_NOT_ADD);
    }

    public function add(Author $author): static
    {
        $this->doAdd($author);

        return $this;
    }

    /** @return array<Author> */
    public function toArray(): array
    {
        /** @var array<Author> $authors */
        $authors = parent::toArray();

        return $authors;
    }
}
