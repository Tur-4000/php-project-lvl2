<?php

namespace Tur4000\Differ\Parsers;

use function Tur4000\Differ\Parsers\jsonParse;
use function Tur4000\Differ\Parsers\yamlParse;

function parserFabric(string $pathToFile)
{
    $fileType = getFileType($pathToFile);
    $data = file_get_contents($pathToFile);

    if ($fileType === '.json') {
        $parsedData = jsonParse($data);
    } elseif ($fileType === '.yaml') {
        $parsedData = yamlParse($data);
    } else {
        die("Udefined file format: {$fileType}\n");
    }

    return $parsedData;
}

function getFileType(string $pathToFile): string
{
    $fileType = substr($pathToFile, strrpos($pathToFile, '.'));

    return strtolower($fileType);
}
