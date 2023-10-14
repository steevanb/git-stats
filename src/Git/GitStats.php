<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git;

use Steevanb\GitStats\{
    Collection\Git\Commit\CommitCollection,
    Collection\Git\Commit\CommitIdCollection,
    Configuration\Configuration,
    Git\Author\AuthorFactory,
    Git\Commit\CommitList,
    Git\Commit\CommitParser
};

readonly class GitStats
{
    protected CommitIdCollection $commitIds;

    protected CommitCollection $commits;

    protected AuthorFactory $authorFactory;

    public function __construct(protected Configuration $configuration)
    {
        $this->commitIds = (new CommitList())->getIds($configuration->getRepositoryPath());

        $this->authorFactory = new AuthorFactory();
        $this->parseCommits();
    }

    public function getCommits(): CommitCollection
    {
        return $this->commits;
    }

    public function getAuthorFactory(): AuthorFactory
    {
        return $this->authorFactory;
    }

    protected function parseCommits(): static
    {
        $this->commits = new CommitCollection();
        $commitParser = new CommitParser($this->configuration->getRepositoryPath(), $this->authorFactory);
        foreach ($this->commitIds->toArray() as $commitId) {
            $this->commits->add($commitParser->parse($commitId));
        }
        $this->commits->setReadOnly();
        $this->authorFactory->getAll()->setReadOnly();

        return $this;
    }
}
