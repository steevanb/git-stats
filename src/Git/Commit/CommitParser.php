<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\Commit;

use Steevanb\GitStats\Git\Author\AuthorFactory;
use Steevanb\PhpCollection\ScalarCollection\StringCollection;
use Symfony\Component\Process\Process;

readonly class CommitParser
{
    public function __construct(protected string $repositoryPath, protected AuthorFactory $authorFactory)
    {
    }

    public function parse(CommitId $id): Commit
    {
        $format =
            CommitDataPrefixEnum::DATE->value . ' %aD%n'
            . CommitDataPrefixEnum::AUTHOR_NAME->value . '%aN%n'
            . CommitDataPrefixEnum::AUTHOR_EMAIL->value . '%ae';
        $process = (new Process(['git', 'show', '--no-patch', '--format="' . $format, $id->getId()]))
            ->mustRun();

        $lines = new StringCollection(explode("\n", trim($process->getOutput(), '"')));
        $lines->remove(3);
        $commitData = CommitDataFactory::create($id, $lines);

        return new Commit(
            $commitData->getDate(),
            $this->authorFactory->get($commitData->getAuthorName(), $commitData->getAuthorEmail())
        );
    }
}
