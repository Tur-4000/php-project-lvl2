<?php

namespace Tur4000\Differ\Parsers;

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

function mergeObject(stdClass $data1, stdClass $data2): stdClass
{
    foreach ($data2 as $key => $value) {
        $data1->$key = $value;
    }

    return $data1;
}
*/
