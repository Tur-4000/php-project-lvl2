<?php

namespace Tur4000\Differ\GenDiff;

use function Tur4000\Differ\Parsers\parser;
use function Tur4000\Differ\Renderer\render;

function genDiff(string $file1, string $file2, string $format = 'stylish'): string
{
    $ast = parser($file1, $file2);

    $diff = render($ast, $format);

    return $diff;
}
