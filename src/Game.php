<?php
namespace AOC10;

class Game {
    private $position = 0;
    private $skip = 0;
    private $list;

    public function __construct(int $listLength) {
        $this->list = array_combine(range(0, $listLength-1), range(0, $listLength-1));
    }
    
    public function processLength($length): void {
        if($length > sizeof($this->list)) {
            throw new \InvalidArgumentException('Lengths submitted should be equal or less than the size of the hash.');
        }
        $this->reverseSet($length);
        $this->updatePosition($length);
        $this->skip++;
    }

    /**
     * Updates the position by adding the length and the skip size.
     * @param $length The length by which to adjust the position
     */
    public function updatePosition($length) {
        $tempPosition = $this->position + $length + $this->skip;
        $this->position = $tempPosition % sizeof($this->list);
    }
    
    private function reverseSet(int $setLength): void {
        // Get set...
        $set = array_slice($this->list, $this->position, $setLength);
        $initialPortionLength = sizeof($set);
        $wrappedPortionLength = $setLength - $initialPortionLength;
        $set = array_merge($set, array_slice($this->list, 0, $wrappedPortionLength));

        // ...reverse...
        $set = array_reverse($set);

        // ...insert back over the sliced portion.
        $reversedInitialPortion = array_slice($set, 0, $initialPortionLength);
        $reversedWrappedPortion = array_slice($set, $initialPortionLength, $wrappedPortionLength);
        array_splice($this->list, $this->position, $initialPortionLength, $reversedInitialPortion);
        if ($wrappedPortionLength !== 0) {
            array_splice($this->list, 0, $wrappedPortionLength, $reversedWrappedPortion);
        }
    }

    public function getFormattedList(): string {
        return implode('  ', $this->list);
    }

    public function getList(): array {
        return $this->list;
    }
}
