<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Git\File;

use Steevanb\GitStats\{
    Collection\Git\File\FileCollection,
    Process\DiffStatProcess
};

class FileFactory
{
    public function __construct(protected string $repositoryPath)
    {
    }

    public function createAll(string $commitId): FileCollection
    {
        $files = new FileCollection();
        $lines = DiffStatProcess::create($this->repositoryPath, $commitId)->mustRun()->getOutputLines();
        foreach ($lines->toArray() as $lineIndex => $line) {
            $line = trim($line);

            /**
             * $lines formats:
             *   b/path/to/file.ext |   30
             *   b/path/to/file.ext              | 1364 ++++++++++
             *   path/to/file.ext   |  198 -
             *   path/to/file.ext               |binary
             * Last line is the summary of changes, we don't care about this line
             */
            if ($lineIndex < $lines->count() - 1) {
                if (str_starts_with($line, 'a/')) {
                    throw new \Exception('TODO: a/');
                } elseif (str_starts_with($line, 'b/')) {
                    $line = substr($line, 2);
                }

                if (str_ends_with($line, '|binary')) {
                    continue;
                }

                [$pathname, $changesCount] = explode(' |', $line);
                $files->add(new File($pathname, intval($changesCount)));
            }
        }

        return $files->setReadOnly();
    }
}
