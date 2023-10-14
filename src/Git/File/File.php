<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\File;

readonly class File
{
    public function __construct(protected string $pathname, protected int $changesCount)
    {
    }

    public function getPathname(): string
    {
        return $this->pathname;
    }

    public function getChangesCount(): int
    {
        return $this->changesCount;
    }
}
