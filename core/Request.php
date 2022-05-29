<?php

namespace Core;

class Request
{

    public static function uri()
    {
        return trim(
            parse_url(
                $_SERVER['REQUEST_URI'],
                PHP_URL_PATH
            ),
            '/'
        );
    }

    public static function method()
    {
        // States whether the request is GET, POST, PUT, DELETE, etc.:
        return $_SERVER['REQUEST_METHOD'];
    }
}
