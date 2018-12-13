<?php

class GuestPage extends SessionManagedPage
{
    public function __construct()
    {
        parent::__construct();

        if ($this->isLogin() === true) {
            $this->redirect_exit($this->getDomain() . 'home.php');
        }
    }
}