<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\Commit;

readonly class CommitData
{
    public function __construct(
        protected \DateTimeImmutable $date,
        protected string $authorName,
        protected string $authorEmail
    ) {
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    public function getAuthorEmail(): string
    {
        return $this->authorEmail;
    }
}
