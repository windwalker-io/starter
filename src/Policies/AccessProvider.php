<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Policies;

use Windwalker\Authorisation\AuthorisationInterface;
use Windwalker\Authorisation\PolicyProviderInterface;

/**
 * The AccessProvider class.
 */
class AccessProvider implements PolicyProviderInterface
{
    /**
     * register
     *
     * @param  AuthorisationInterface  $authorisation
     *
     * @return  void
     */
    public function register(AuthorisationInterface $authorisation): void
    {
        $authorisation->addPolicy('can.save', function ($user, $action) {
            show($user, $action);
            return $action === 'save';
        });
    }
}
