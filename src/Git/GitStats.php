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
use Symfony\Component\Console\{
    Helper\ProgressBar,
    Output\OutputInterface
};

readonly class GitStats
{
    protected StringCollection $commitIds;

    protected CommitCollection $commits;

    protected AuthorFactory $authorFactory;

    public function __construct(protected Configuration $configuration, OutputInterface $output)
    {
        $this->authorFactory = new AuthorFactory();
        $commitFactory = new CommitFactory($this->configuration->getRepositoryPath(), $this->authorFactory);
        $output->writeln('Get commits ids...');
        $this->commitIds = $commitFactory->getIds();
        $this->commits = new CommitCollection();
        $this->addCommits($commitFactory, $output);
        $this->authorFactory->getAll()->setReadOnly();
    }

    protected function addCommits(CommitFactory $commitFactory, OutputInterface $output): static
    {
        $output->writeln('Get commits informations...');
        $progressBar = new ProgressBar($output, $this->commitIds->count());
        foreach ($this->commitIds->toArray() as $commitId) {
            $this->commits->add($commitFactory->create($commitId));
            $progressBar->advance();
        }
        $this->commits->setReadOnly();
        $progressBar->finish();
        $output->writeln('');

        return $this;
    }
}
