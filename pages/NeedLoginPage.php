<?php

class NeedLoginPage extends SessionManagedPage
{
    public function __construct()
    {
        parent::__construct();

        if ($this->isLogin() === false) {
            $this->redirect_exit($this->getDomain());
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect_exit($this->getDomain() . 'logout.php');
    }
}