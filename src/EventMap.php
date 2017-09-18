<?php

namespace Yadahan\AuthenticationLog;

trait EventMap
{
    /**
     * The Authentication Log event / listener mappings.
     *
     * @var array
     */
    protected $events = [
        'Illuminate\Auth\Events\Login' => [
            'Yadahan\AuthenticationLog\Listeners\LogSuccessfulLogin',
        ],

        'Illuminate\Auth\Events\Logout' => [
            'Yadahan\AuthenticationLog\Listeners\LogSuccessfulLogout',
        ],
    ];
}
