<?php

namespace Tur4000\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Tur4000\Differ\GenDiff\render;

class RenderTest extends TestCase
{
    public function testRender()
    {
        $ast = [
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

        $this->assertEquals($expected, render($ast));
    }
}
