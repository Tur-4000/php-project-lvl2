<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\GenDiff\genDiff;

class GenDiffTest extends TestCase
{
    public function testGenDiff()
    {
        $plainExpected = file_get_contents('./tests/fixtures/plainExpected.txt');

        $pathToFile1 = './tests/fixtures/file01.json';
        $pathToFile2 = './tests/fixtures/file02.json';

        $this->assertEquals($plainExpected, genDiff($pathToFile1, $pathToFile2));

        $pathToFile3 = './tests/fixtures/file01.yaml';
        $pathToFile4 = './tests/fixtures/file02.yaml';

        $this->assertEquals($plainExpected, genDiff($pathToFile3, $pathToFile4));
    }
}
