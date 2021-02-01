<?php

namespace Differ\Tests;

use function Differ\GenDiff\boolToString;
use PHPUnit\Framework\TestCase;

class BoolToStringTest extends TestCase
{
    public function testBoolToString1()
    {
        $this->assertEquals('true', boolToString(true));
        $this->assertEquals('false', boolToString(false));
    }
}
