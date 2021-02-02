<?php

namespace Differ\Parsers;

function jsonParse(string $json)
{
    $parsedData = json_decode($json, true);

    if (json_last_error() === JSON_ERROR_NONE) {
        return $parsedData;
    } else {
        die("JSON: " . json_last_error_msg() . PHP_EOL);
    }
}
