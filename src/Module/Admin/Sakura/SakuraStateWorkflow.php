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
        $workflow->setStateMeta(State::PUBLISHED(), 'Published', 'fa fa-fw fa-check', 'success');
        $workflow->setStateMeta(State::UNPUBLISHED(), 'Unpublished', 'fa fa-fw fa-xmark', 'danger');
        $workflow->setStateMeta(State::TRASHED(), 'Trashed', 'fa fa-fw fa-trash');
        $workflow->setStateMeta(State::ARCHIVED(), 'Archived', 'fa fa-fw fa-file-zipper');

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
        )
            ->button('fa fa-fw fa-check', 'Publish');

        $workflow->addTransition(
            'unpublish',
            State::PUBLISHED(),
            State::UNPUBLISHED()
        )
            ->button('fa fa-fw fa-xmark', 'Unpublish');

        $workflow->addTransition(
            'archive',
            State::UNPUBLISHED(),
            State::ARCHIVED(),
        )
            ->button('fa fa-fw fa-file-zipper', 'Archive');

        $workflow->addTransition(
            'trash',
            [
                State::UNPUBLISHED(),
                State::PUBLISHED(),
                State::ARCHIVED()
            ],
            State::TRASHED(),
        )
            ->button('fa fa-fw fa-trash', 'Trash');

        $workflow->addTransition(
            'untrash',
            State::TRASHED(),
            State::UNPUBLISHED(),
        )
            ->button('fa fa-fw fa-check', 'Untrash');
    }
}
