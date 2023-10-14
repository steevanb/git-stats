<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\Commit;

use Steevanb\GitStats\Collection\Git\Commit\CommitIdCollection;
use Symfony\Component\Process\Process;

class CommitList
{
    public function getIds(string $path): CommitIdCollection
    {
        $process = (new Process(['git', 'log', '--pretty=format:"%H"', $path]))
            ->mustRun();

        $ids = new CommitIdCollection();
        foreach (explode("\n", $process->getOutput()) as $commitId) {
            $ids->add(new CommitId(trim($commitId, '"')));
        }

        return $ids->setReadOnly();
    }
}
