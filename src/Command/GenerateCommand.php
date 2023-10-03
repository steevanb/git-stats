<?php

declare(strict_types=1);

namespace Steevanb\GitStats\Command;

use Symfony\Component\Console\{
    Attribute\AsCommand,
    Command\Command,
    Input\InputInterface,
    Output\OutputInterface
};

#[AsCommand('generate', 'Generate statistics')]
class GenerateCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return static::SUCCESS;
    }
}
