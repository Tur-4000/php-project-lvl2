<?php

namespace Differ\GenDiff;

function genDiff(string $file1, string $file2, string $format = 'stylish')
{
    $firstFile = file_get_contents($file1);
    $secondFile = file_get_contents($file2);

    $data1 = json_decode($firstFile, true);
    $data2 = json_decode($secondFile, true);

    $ast = buildAst($data1, $data2);

    $diff = render($ast);

    return $diff;
}

function buildAst($data1, $data2)
{
    $ast = [];

    foreach ($data1 as $key => $value) {
        if (!array_key_exists($key, $data2)) {
            $ast[$key] = [
                'status' => 'deleted',
                'value' => $value
            ];
        } elseif ($value === $data2[$key]) {
            $ast[$key] = [
                'status' => 'unchanged',
                'value' => $value
            ];
        } elseif ($value !== $data2[$key]) {
            $ast[$key] = [
                'status' => 'modified',
                'valueBefore' => $value,
                'valueAfter' => $data2[$key]
            ];
        }
    }

    foreach ($data2 as $key => $value) {
        if (!array_key_exists($key, $data1)) {
            $ast[$key] = [
                'status' => 'added',
                'value' => $value
            ];
        }
    }

    ksort($ast);

    return $ast;
}

function render($ast)
{
    $result = '{' . PHP_EOL;
    foreach ($ast as $key => $value) {
        switch ($value['status']) {
            case 'unchanged':
                $result .= "    {$key}: {$value['value']}" . PHP_EOL;
                break;
            case 'modified':
                $result .= "  - {$key}: {$value['valueBefore']}" . PHP_EOL;
                $result .= "  + {$key}: {$value['valueAfter']}" . PHP_EOL;
                break;
            case 'added':
                $result .= "  + {$key}: {$value['value']}" . PHP_EOL;
                break;
            case 'deleted':
                $result .= "  - {$key}: {$value['value']}" . PHP_EOL;
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
