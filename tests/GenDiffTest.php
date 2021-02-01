<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\GenDiff\genDiff;

class GenDiffTest extends TestCase
{
    public function testGenDiff()
    {
        $pathToFile1 = './tests/fixtures/file01.json';
        $pathToFile2 = './tests/fixtures/file02.json';

        $expected = <<<RENDER
{
  - follow: false
    host: hexlet.io
  - proxy: 123.234.53.22
  - timeout: 50
  + timeout: 20
  + verbose: true
}
RENDER;

        $this->assertEquals($expected, genDiff($pathToFile1, $pathToFile2));
    }
}
