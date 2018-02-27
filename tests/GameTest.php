<?php
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase {
    public function testSimpleReverse(): void {
        $game = new AOC10\Game(5);

        $game->processLength(3);
        $this->assertEquals($game->getList(), [2, 1, 0, 3, 4]);

        $game->processLength(4);
        $this->assertEquals($game->getList(), [4, 3, 0, 1, 2]);

        $game->processLength(1);
        $this->assertEquals($game->getList(), [4, 3, 0, 1, 2]);

        $game->processLength(5);
        $this->assertEquals($game->getList(), [3, 4, 2, 1, 0]);
    }

    public function testInvalidLength(): void {
        $this->expectException(InvalidArgumentException::class);
        $game = new AOC10\Game(5);
        $game->processLength(10);
    }
}
