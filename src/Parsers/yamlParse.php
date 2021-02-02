<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

function yamlParse(string $yaml)
{
    try {
        // return  Yaml::parse($yaml, Yaml::PARSE_OBJECT_FOR_MAP);
        return  Yaml::parse($yaml);
    } catch (ParseException $exception) {
        die("Unable to parse the YAML string: {$exception->getMessage()}");
        // printf('Unable to parse the YAML string: %s', $exception->getMessage());
    }
}
