<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Command;

use Symfony\Component\Console\{
    Attribute\AsCommand,
    Command\Command,
    Input\InputInterface,
    Output\OutputInterface
};
use Steevanb\GitStats\{
    Configuration\Configuration,
    Git\GitStats
};

#[AsCommand('generate', 'Generate statistics')]
class GenerateCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $gitStats = new GitStats(new Configuration(), $output);

        return static::SUCCESS;
    }
}
