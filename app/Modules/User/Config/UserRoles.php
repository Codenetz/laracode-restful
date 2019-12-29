<?php

defined('ROLES') or define('ROLES', [
    'ROLE_USER' => 'ROLE_USER',
    'ROLE_MODERATOR' => 'ROLE_MODERATOR',
    'ROLE_ADMIN' => 'ROLE_ADMIN'
]);

return
    [
        'ROLES' => ROLES,
        'LEVELS' =>
            [
                ROLES['ROLE_USER'] => [
                    ROLES['ROLE_USER']
                ],
                ROLES['ROLE_MODERATOR'] => [
                    ROLES['ROLE_USER'],
                    ROLES['ROLE_MODERATOR']
                ],
                ROLES['ROLE_ADMIN'] => [
                    ROLES['ROLE_USER'],
                    ROLES['ROLE_MODERATOR'],
                    ROLES['ROLE_ADMIN']
                ]
            ]
    ];
