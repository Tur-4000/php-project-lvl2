<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\GenDiff\buildAst;

class BuildAstTest extends TestCase
{
    public function testBuildAst()
    {
        $expected = [
            'follow' => [
                'status' => 'deleted',
                'value' => false,
            ],
            'host' => [
                'status' => 'unchanged',
                'value' => 'hexlet.io',
            ],
            'proxy' => [
                'status' => 'deleted',
                'value' => '123.234.53.22',
            ],
            'timeout' => [
                'status' => 'modified',
                'valueBefore' => 50,
                'valueAfter' => 20,
            ],
            'verbose' => [
                'status' => 'added',
                'value' => true,
            ],
        ];
        $data1 = [
            'host' => 'hexlet.io',
            'timeout' => 50,
            'proxy' => '123.234.53.22',
            'follow' => false,
        ];
        $data2 = [
            'timeout' => 20,
            'verbose' => true,
            'host' => 'hexlet.io',
        ];

        $this->assertEquals($expected, buildAst($data1, $data2));
    }
}
