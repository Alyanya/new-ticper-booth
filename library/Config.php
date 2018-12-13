<?php

class Config
{
    private static $config = [];

    /**
     * 絶対パスね！！
     * @param string $path
     */
    public static function load(string $path)
    {
        /** @var array */
        $config_list = require_once $path;
        foreach ($config_list as $name => $data) {
            $config[$name] = $data;
        }
    }

    public static function get(string $key)
    {
        return self::$config[$key] ?? null;
    }
}

