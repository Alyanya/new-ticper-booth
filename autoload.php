<?php

function load_dir(string $dir)
{
    foreach (glob("{$dir}/*.php") as $file) {
        require_once $file;
    }
}

load_dir('library');
load_dir('pages');

Config::load(realpath('config/config.php'));