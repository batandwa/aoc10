<?php
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase {
    /**
     * @Deprecated
     */
    public function xtestSimpleReverse(): void {
        $game = new AOC10\Game(5, "3415");
        $game->process();
        $this->assertEquals($game->getList(), [3, 4, 2, 1, 0]);
    }

    public function testInvalidLength(): void {
        $this->expectException(InvalidArgumentException::class);
        $game = new AOC10\Game(5, "9");
        $game->process();
    }

    public function testSequenceToHash(): void {
        $game = new AOC10\Game(256, "AoC 2017");
        $hash = $game->process();
        $this->assertEquals('33efeb34ea91902bb2f59c9920caa6cd', implode('', $hash));

        $game = new AOC10\Game(256, '');
        $hash = $game->process();
        $this->assertEquals('a2582a3a0e66e6e86e3812dcb672a272', implode('', $hash));

        $game = new AOC10\Game(256, '1,2,3');
        $hash = $game->process();
        $this->assertEquals('3efbe78a8d82f29979031a4aa0b16a9d', implode('', $hash));

        $game = new AOC10\Game(256, '1,2,4');
        $hash = $game->process();
        $this->assertEquals('63960835bcdc130f0b66d7ff4f6a5a8e', implode('', $hash));
    }
}
