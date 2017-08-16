<?php

namespace Config;

function getConfig($type)
{
    $db = [
        'host' => '',
        'port' => '',
        'user' => '',
        'pass' => '',
        'db' => '',
        'charset' => ''
    ];

    return $$type;
}