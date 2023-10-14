<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\Commit;

use Steevanb\GitStats\{
    Collection\Git\File\FileCollection,
    Git\Author\Author
};

readonly class Commit
{
    protected FileCollection $files;

    public function __construct(protected \DateTimeImmutable $date, protected Author $author)
    {
        $this->files = new FileCollection();
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function getFiles(): FileCollection
    {
        return $this->files;
    }
}
