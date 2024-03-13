<?php

namespace Yadahan\AuthenticationLog\Listeners;

use Illuminate\Auth\Events\OtherDeviceLogout;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yadahan\AuthenticationLog\AuthenticationLog;

class LogSuccessfulOtherDeviceLogout
{
    /**
     * The request.
     *
     * @var \Illuminate\Http\Request
     */
    public $request;

    /**
     * Create the event listener.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(OtherDeviceLogout $event)
    {
        if ($event->user) {
            $user = $event->user;

            $authenticationLog = $user->authentications()->whereNull('logout_at')->get()->skip(1);

            $user->authentications()->whereIn('id', $authenticationLog->pluck('id'))->update([
                'logout_at' => Carbon::now(),
            ]);
        }
    }
}
