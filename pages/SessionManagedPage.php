<?php

class SessionManagedPage extends Page
{
    public static function boot()
    {
        parent::boot();
        session_start();
    }

    public function isLogin() : bool
    {
        return isset($_SESSION['UserId']);
    }
}

