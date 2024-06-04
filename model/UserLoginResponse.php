<?php

class UserLoginResponse
{
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}