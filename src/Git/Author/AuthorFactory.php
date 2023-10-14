<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\Author;

use Steevanb\GitStats\Collection\Git\Author\AuthorCollection;

class AuthorFactory
{
    protected AuthorCollection $authors;

    public function __construct()
    {
        $this->authors = new AuthorCollection();
    }

    public function get(string $name, string $email): Author
    {
        $return = null;
        foreach ($this->authors->toArray() as $author) {
            if ($author->getName() === $name && $author->getEmail() === $email) {
                $return = $author;
                break;
            }
        }
        if ($return instanceof Author === false) {
            $return = new Author($name, $email);
            $this->authors->add($return);
        }

        return $return;
    }

    public function getAll(): AuthorCollection
    {
        return $this->authors;
    }
}
