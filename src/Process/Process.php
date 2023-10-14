<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Process;

use Steevanb\PhpCollection\ScalarCollection\StringCollection;
use Symfony\Component\Process\Process as SymfonyProcess;

class Process extends SymfonyProcess
{
    public function getOutputLines(bool $removeEmptyLastLine = true): StringCollection
    {
        $lines = new StringCollection(explode("\n", trim($this->getOutput(), '"')));
        if ($removeEmptyLastLine && $lines->get($lines->count() - 1) === '') {
            $lines->remove($lines->count() - 1);
        }

        return $lines->setReadOnly();
    }
}
