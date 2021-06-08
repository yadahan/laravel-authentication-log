<?php

namespace KeyShang\AuthenticationLog\Phpdoc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use KeyShang\AuthenticationLog\AuthenticationLogable;

/**
 * Class for phpdoc
 *
 * @property string $email
 * @property Carbon $login_at
 * @property string $ip_address
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use AuthenticationLogable;
}