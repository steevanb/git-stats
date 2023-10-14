<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\Author;

readonly class Author
{
    public function __construct(protected string $name, protected string $email)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
