<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git;

use Steevanb\GitStats\{
    Collection\Git\Commit\CommitCollection,
    Configuration\Configuration,
    Git\Author\AuthorFactory,
    Git\Commit\CommitFactory
};
use Steevanb\PhpCollection\ScalarCollection\StringCollection;

readonly class GitStats
{
    protected StringCollection $commitIds;

    protected CommitCollection $commits;

    protected AuthorFactory $authorFactory;

    public function __construct(protected Configuration $configuration)
    {
        $this->authorFactory = new AuthorFactory();
        $commitFactory = new CommitFactory($this->configuration->getRepositoryPath(), $this->authorFactory);
        $this->commitIds = $commitFactory->getIds();
        $this->commits = new CommitCollection();
        $this->addCommits($commitFactory);
        $this->authorFactory->getAll()->setReadOnly();
    }

    protected function addCommits(CommitFactory $commitFactory): static
    {
        foreach ($this->commitIds->toArray() as $commitId) {
            $this->commits->add($commitFactory->create($commitId));
        }
        $this->commits->setReadOnly();

        return $this;
    }
}
