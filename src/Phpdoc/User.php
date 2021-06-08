<?php

namespace KeyShang\AuthenticationLog\Phpdoc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use KeyShang\AuthenticationLog\AuthenticationLogable;

/**
 * Class for phpdoc
 *
 * @property string $email
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use AuthenticationLogable;
}