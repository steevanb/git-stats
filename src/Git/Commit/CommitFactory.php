<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\Commit;

use Steevanb\GitStats\{
    Git\Author\AuthorFactory,
    Git\File\FileFactory,
    Process\GitLogIdProcess
};
use Steevanb\PhpCollection\ScalarCollection\StringCollection;

readonly class CommitFactory
{
    public function __construct(protected string $repositoryPath, protected AuthorFactory $authorFactory)
    {
    }

    public function create(string $id): Commit
    {
        $data = CommitDataFactory::create($this->repositoryPath, $id);
        $commit = new Commit(
            $data->getDate(),
            $this->authorFactory->get($data->getAuthorName(), $data->getAuthorEmail())
        );
        $this->addFiles($commit, $id);

        return $commit;
    }

    public function getIds(): StringCollection
    {
        $process = (new GitLogIdProcess($this->repositoryPath))->mustRun();
        $ids = new StringCollection();
        foreach ($process->getOutputLines()->toArray() as $commitId) {
            $ids->add(trim($commitId, '"'));
        }

        return $ids->setReadOnly();
    }

    protected function addFiles(Commit $commit, string $id): static
    {
        foreach ((new FileFactory($this->repositoryPath))->createAll($id)->toArray() as $file) {
            $commit->getFiles()->add($file);
        }
        $commit->getFiles()->setReadOnly();

        return $this;
    }
}
