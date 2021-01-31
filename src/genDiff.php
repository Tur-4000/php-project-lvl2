<?php

namespace Differ\GenDiff;

function genDiff(string $file1, string $file2, string $format = 'stylish')
{
    $firstFile = file_get_contents($file1);
    $secondFile = file_get_contents($file2);

    $data1 = json_decode($firstFile, true);
    $data2 = json_decode($secondFile, true);

    var_dump($data1);
    var_dump($data2);
}
