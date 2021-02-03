<?php

namespace Tur4000\Differ\GenDiff;

use function Tur4000\Differ\Parsers\parser;

function genDiff(string $file1, string $file2, string $format = 'stylish'): string
{
    $data1 = parser($file1);
    $data2 = parser($file2);

    $ast = buildAst($data1, $data2);

    $diff = render($ast);

    return $diff;
}


function buildAst($data1, $data2)
{
    $mergedData = array_merge($data1, $data2);
    $ast = [];

    foreach ($mergedData as $key => $value) {
        if (!array_key_exists($key, $data1)) {
            $ast[$key] = [
                'status' => 'added',
                'value' => $value
            ];
        } elseif (!array_key_exists($key, $data2)) {
            $ast[$key] = [
                'status' => 'deleted',
                'value' => $value
            ];
        } elseif ($value === $data1[$key]) {
            $ast[$key] = [
                'status' => 'unchanged',
                'value' => $value
            ];
        } elseif ($value !== $data1[$key]) {
            $ast[$key] = [
                'status' => 'modified',
                'valueBefore' => $data1[$key],
                'valueAfter' => $value,
            ];
        }
    }

    ksort($ast);

    return $ast;
}


/*
function buildAst($data1, $data2)
{
    $mergedData = mergeObject($data1, $data2);

    foreach ($mergedData as $key => $value) {

    }
}
*/
function mergeObject(stdClass $data1, stdClass $data2): stdClass
{
    foreach ($data2 as $key => $value) {
        $data1->$key = $value;
    }

    return $data1;
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
