<?php

class IndexPage extends GuestPage
{
    public function __construct()
    {
        parent::__construct();

        if ($this->getRequestMethod() === 'POST') {
            $user_id = (string)filter_input(INPUT_POST, 'user_id');
            $password = (string)filter_input(INPUT_POST, 'password');
            if ($user_id !== false && strlen($user_id) > 0 && $password !== false && strlen($password) > 0) {
                $success = $this->login($user_id, $password);
                if ($success) {
                    $this->redirect_exit($this->getDomain() . 'home.php');
                }
            }
        }
    }

    private function login(string $user_id, string $password) : bool
    {
        #$escaped_user_id =
        return true;
    }
}