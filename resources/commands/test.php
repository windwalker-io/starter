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
use Windwalker\Core\Console\CommandInterface;
use Windwalker\Core\Console\CommandWrapper;
use Windwalker\Core\Console\Input\InputArgument;
use Windwalker\Core\Console\Input\InputOption;
use Windwalker\Core\Console\IOInterface;

return new
#[
    CommandWrapper('Hello command'),
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
