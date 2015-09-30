<?php

define("DEFAULT_CHECKER", "default_checker");
define("INT_CHECKER", "int_checker");
define("IMAGE_URL_CHECKER", "image_url_checker");

function default_checker()
{
    return YES;
}

function int_checker($value)
{
    if (is_numeric($value)) {
        return YES;
    }
    return ERR;
}

function image_url_checker($url)
{
    $match = preg_match("/(http:\/\/)?\w+/", $url);
    if ($match === 1) {
        return YES;
    }
    return ERR;
}
