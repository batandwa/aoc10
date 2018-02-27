<?php
use AOC10\Utils;
use PHPUnit\Framework\TestCase;

final class UtilsTest extends TestCase {
    public function testMultiXor() {
        $xor = Utils::multipleXor([65, 27,9,1,4,3,40,50,91,7,6,0,2,5,68,22]);
        $this->assertEquals(64, $xor);
    }

    public function testLengthPreparation() {
        $sequence = '1,2,3';
        $expectedLengths = [49, 44, 50, 44, 51, 17, 31, 73, 47, 23];
        $this->assertEquals(Utils::addSuffix(Utils::parseLengths($sequence)), $expectedLengths);
    }
}
