<?php

class Page
{
    protected static $instance;

    protected function __construct()
    {
        self::$instance = $this;
    }

    /** @return static */
    public static function _()
    {
        return self::$instance;
    }

    public static function boot()
    {
        new static();
    }

    /** シャットダウン時に何か必要ならこの子をオーバーライドして */
    protected function shutdown_hook() { }

    public function shutdown()
    {
        $this->shutdown_hook();
        exit();
    }

    public function redirect_exit(string $to)
    {
        header("Location: {$to}");
        $this->shutdown();
    }

    public function getDomain() : string
    {
        return Config::get('domain');
    }

    public function getRequestMethod() : string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}