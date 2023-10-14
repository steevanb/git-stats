<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\Commit;

readonly class CommitId
{
    public function __construct(protected string $id)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }
}
