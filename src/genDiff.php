<?php

namespace Differ\GenDiff;

function genDiff(string $file1, string $file2, string $format = 'stylish')
{
    $firstFile = file_get_contents($file1);
    $secondFile = file_get_contents($file2);

    $data1 = json_decode($firstFile, true);
    $data2 = json_decode($secondFile, true);

    $ast = buildAst($data1, $data2);

    $diff = buildDiff($ast);

    return $diff;
}

function buildAst($data1, $data2)
{
    $ast = [];

    foreach ($data1 as $key => $value) {
        if (!array_key_exists($key, $data2)) {
            $ast[$key] = ['deleted', [$value]];
        } elseif ($value === $data2[$key]) {
            $ast[$key] = ['unchanged', [$value]];
        } elseif ($value !== $data2[$key]) {
            $ast[$key] = ['modified', [$value, $data2[$key]]];
        }
    }

    foreach ($data2 as $key => $value) {
        if (!array_key_exists($key, $data1)) {
            $ast[$key] = ['added', [$value]];
        }
    }

    ksort($ast);

    return $ast;
}

function buildDiff($ast)
{
    $result = '{' . PHP_EOL;
    foreach ($ast as $key => $value) {
        switch ($value[0]) {
            case 'unchanged':
                $result .= "    {$key}: {$value[1][0]}" . PHP_EOL;
                break;
            case 'modified':
                $result .= "  - {$key}: {$value[1][0]}" . PHP_EOL;
                $result .= "  + {$key}: {$value[1][1]}" . PHP_EOL;
                break;
            case 'added':
                $result .= "  + {$key}: {$value[1][0]}" . PHP_EOL;
                break;
            case 'deleted':
                $result .= "  - {$key}: {$value[1][0]}" . PHP_EOL;
                break;
        }
    }

    $result .= '}';

    return $result;
}
