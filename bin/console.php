<?php

declare(strict_types=1);

use Steevanb\GitStats\Command\GenerateCommand;
use Symfony\Component\Console\Application;

require __DIR__ . '/../vendor/autoload.php';

$application = new Application();

$application->add(new GenerateCommand());

$application
    ->setDefaultCommand(GenerateCommand::getDefaultName())
    ->run();
