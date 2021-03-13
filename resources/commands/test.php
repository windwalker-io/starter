<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Windwalker\Console\CommandInterface;
use Windwalker\Console\CommandWrapper;
use Windwalker\Console\Input\InputArgument;
use Windwalker\Console\Input\InputOption;
use Windwalker\Console\IOInterface;

return new
#[
    CommandWrapper(description: 'Hello command'),
    InputArgument(
        'name',
        InputArgument::OPTIONAL,
        'SSSSS',
        'foo'
    ),
    InputOption(
        'foo',
        'f',
        InputOption::VALUE_OPTIONAL,
        'GGGGG',
        'ssdasds'
    )
]
class implements CommandInterface {
    /**
     * @inheritDoc
     */
    public function configure(Command $command): void
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(IOInterface $io): int
    {
        show($io->getArgument('name'), $io->getOption('foo'));
    }
};
