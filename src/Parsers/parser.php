<?php

namespace Tur4000\Differ\Parsers;

use function Tur4000\Differ\Parsers\jsonParse;
use function Tur4000\Differ\Parsers\yamlParse;

function parser(string $pathToFile)
{
    $fileType = strtolower(substr($pathToFile, strrpos($pathToFile, '.')));

    $data = file_get_contents($pathToFile);

    if ($fileType === '.json') {
        $result = jsonParse($data);
    } elseif ($fileType === '.yaml') {
        $result = yamlParse($data);
    } else {
        die("Udefined file format: {$fileType}\n");
    }

    return $result;
}
