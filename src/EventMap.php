<?php

namespace KeyShang\AuthenticationLog;

trait EventMap
{
    /**
     * The Authentication Log event / listener mappings.
     *
     * @var array
     */
    protected $events = [
        'Illuminate\Auth\Events\Login' => [
            'KeyShang\AuthenticationLog\Listeners\LogSuccessfulLogin',
        ],
    ];
}
