<?php

namespace PHPSTORM_META {

    override(
        \Lyrasoft\Luna\User\UserService::getUser(),
        map([
            '' => \Lyrasoft\Luna\Entity\User::class
        ])
    );

    override(
        \Lyrasoft\Luna\User\UserService::getCurrentUser(),
        map([
            '' => \Lyrasoft\Luna\Entity\User::class
        ])
    );

    override(
        \Lyrasoft\Luna\User\UserService::getLoggedInUser(),
        map([
            '' => \Lyrasoft\Luna\Entity\User::class
        ])
    );

    override(
        \Lyrasoft\Luna\User\UserService::load(),
        map([
            '' => \Lyrasoft\Luna\Entity\User::class
        ])
    );

    override(
        \Lyrasoft\Luna\User\UserService::mustLoad(),
        map([
            '' => \Lyrasoft\Luna\Entity\User::class
        ])
    );

    override(
        \Lyrasoft\Luna\User\UserService::createUserEntity(),
        map([
            '' => \Lyrasoft\Luna\Entity\User::class
        ])
    );
}
