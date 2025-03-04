<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Notify New Device
    |--------------------------------------------------------------------------
    |
    | Here you define whether to receive notifications when logging from a new device.
    |
    */

    'notify' => env('AUTHENTICATION_LOG_NOTIFY', true),

    /*
    |--------------------------------------------------------------------------
    | Old Logs Clear
    |--------------------------------------------------------------------------
    |
    | When the clean-command is executed, all authentication logs older than
    | the number of days specified here will be deleted.
    |
    */

    'older' => 365,

    /*
    |--------------------------------------------------------------------------
    | Set AuthenticationLog table name
    |--------------------------------------------------------------------------
    |
    | When using the AuthenticationLog model, we need to known wich tabel should
    | be used to store the logs.
    |
    */

    'table_name' => 'authentication_log',
];
