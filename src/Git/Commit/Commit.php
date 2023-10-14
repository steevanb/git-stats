<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\Commit;

use Steevanb\GitStats\Git\Author\Author;

readonly class Commit
{
    public function __construct(protected \DateTimeImmutable $date, protected Author $author)
    {
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }
}
