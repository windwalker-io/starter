<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Sakura;

use App\Enum\State;
use App\Module\Admin\Category\CategoryState;
use Unicorn\Attributes\StateMachine;
use Unicorn\Workflow\AbstractWorkflow;
use Unicorn\Workflow\WorkflowController;

/**
 * The SakuraStateWorkflow class.
 */
#[StateMachine(
    field: 'state',
    enum: State::class,
    strict: true
)]
class SakuraStateWorkflow extends AbstractWorkflow
{
    public function configure(WorkflowController $workflow): void
    {
        $workflow->setStateTitle(State::PUBLISHED(), 'Published');
        $workflow->setStateTitle(State::UNPUBLISHED(), 'Unpublished');
        $workflow->setStateTitle(State::TRASHED(), 'Trashed');
        $workflow->setStateTitle(State::ARCHIVED(), 'Archived');

        $workflow->setInitialStates(
            [
                State::PUBLISHED(),
                State::UNPUBLISHED()
            ]
        );

        $workflow->addTransition(
            'publish',
            State::UNPUBLISHED(),
            State::PUBLISHED()
        );

        $workflow->addTransition(
            'unpublish',
            State::PUBLISHED(),
            State::UNPUBLISHED()
        );

        $workflow->addTransition(
            'archive',
            State::UNPUBLISHED(),
            State::ARCHIVED(),
        );

        $workflow->addTransition(
            'trash',
            [
                State::UNPUBLISHED(),
                State::PUBLISHED(),
                State::ARCHIVED()
            ],
            State::TRASHED(),
        );

        $workflow->addTransition(
            'untrash',
            State::TRASHED(),
            State::UNPUBLISHED(),
        );
    }
}
