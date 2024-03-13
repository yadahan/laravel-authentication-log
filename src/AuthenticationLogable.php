<?php

namespace Yadahan\AuthenticationLog;

trait AuthenticationLogable
{
    /**
     * Get the entity's authentications.
     */
    public function authentications()
    {
        return $this->morphMany(AuthenticationLog::class, 'authenticatable')->latest('login_at');
    }

    /**
     * The Authentication Log notifications delivery channels.
     *
     * @return array
     */
    public function notifyAuthenticationLogVia()
    {
        return ['mail'];
    }

    /**
     * Get the entity's last login at.
     */
    public function lastLoginAt()
    {
        return optional($this->authentications()->first())->login_at;
    }

    /**
     * Get the entity's last logout at.
     */
    public function lastLogoutAt()
    {
        return optional($this->authentications()->first())->logout_at;
    }
    
     /**
     * Get the entity's current online status
     */
    public function isOnline()
    {
        return optional($this->lastLogoutAt()) === null;
    }
    
    /**
     * Get the entity's last login ip address.
     */
    public function lastLoginIp()
    {
        return optional($this->authentications()->first())->ip_address;
    }

    /**
     * Get the entity's previous login at.
     */
    public function previousLoginAt()
    {
        return optional($this->authentications()->skip(1)->first())->login_at;
    }

    /**
     * Get the entity's previous login ip.
     */
    public function previousLoginIp()
    {
        return optional($this->authentications()->skip(1)->first())->ip_address;
    }
}
