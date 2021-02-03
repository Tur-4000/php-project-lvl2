<?php

namespace Tur4000\Differ\GenDiff;

use function Tur4000\Differ\Parsers\parser;

function genDiff(string $file1, string $file2, string $format = 'stylish'): string
{
    $ast = parser($file1, $file2);

    $diff = render($ast);

    return $diff;
}

function render(array $ast): string
{
    $result = '{' . PHP_EOL;
    foreach ($ast as $key => $value) {
        switch ($value['status']) {
            case 'unchanged':
                $val = is_bool($value['value']) ? boolToString($value['value']) : $value['value'];
                $result .= "    {$key}: {$val}" . PHP_EOL;
                break;
            case 'modified':
                $valBefore = is_bool($value['valueBefore']) ?
                    boolToString($value['valueBefore']) :
                    $value['valueBefore'];
                $valAfter = is_bool($value['valueAfter']) ?
                    boolToString($value['valueAfter']) :
                    $value['valueAfter'];
                $result .= "  - {$key}: {$valBefore}" . PHP_EOL;
                $result .= "  + {$key}: {$valAfter}" . PHP_EOL;
                break;
            case 'added':
                $val = is_bool($value['value']) ? boolToString($value['value']) : $value['value'];
                $result .= "  + {$key}: {$val}" . PHP_EOL;
                break;
            case 'deleted':
                $val = is_bool($value['value']) ? boolToString($value['value']) : $value['value'];
                $result .= "  - {$key}: {$val}" . PHP_EOL;
                break;
        }
    }

    $result .= '}';

    return $result;
}

function boolToString(bool $value): string
{
    if ($value === true) {
        return 'true';
    }

    if ($value === false) {
        return 'false';
    }
}
