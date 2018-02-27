<?php
namespace AOC10;

class Game {
    private $position = 0;
    private $skip = 0;
    private $slots;
    private $inputSequence;

    const CHUNK_SIZE = 16;

    public function __construct(int $listLength, $inputSequence) {
        $this->slots = array_combine(range(0, $listLength - 1), range(0, $listLength - 1));
        $this->inputSequence = $inputSequence;
    }

    /**
     * Process the input sequence.
     * @return array
     */
    function process(): array {
        $preparedInputLengths = Utils::addSuffix(Utils::parseLengths($this->inputSequence));
        for ($j = 0; $j < 64; $j++) {
            array_map([$this, 'processLength'], $preparedInputLengths);
        }

        $chunked = $this->chunk();
        $hexed = $this->chunkToHex($chunked);

        return $hexed;
    }

    /**
     * Split the slots into the predetermined sizes.
     * @return array A nested array chunked slots.
     */
    private function chunk(): array {
        return array_chunk($this->slots, self::CHUNK_SIZE);
    }

    /**
     * Reduce each chunk to a single decimal value using XOR then
     * convert the result to a hexadecimal value.
     * @param array $chunks Chunks to be reduced.
     * @return array
     */
    private function chunkToHex(array $chunks): array {
        $hexed = [];
        foreach ($chunks as $chunk) {
            $xorred = Utils::multipleXor($chunk);
            $hexed[] = str_pad(dechex($xorred), 2, '0', STR_PAD_LEFT);
        }

        return $hexed;
    }

    /**
     * Process an item taken from the input sequence.
     * @param $length int Length to be processed
     */
    private function processLength(int $length): void {
        if ($length > sizeof($this->slots)) {
            throw new \InvalidArgumentException('Lengths submitted should be equal or less than the size of the hash.');
        }
        $this->reverseSet($length);
        $this->updatePosition($length);
        $this->skip++;
    }

    /**
     * Updates the position by adding the length and the skip size.
     * @param $length int The length by which to adjust the position
     */
    private function updatePosition(int $length) {
        $tempPosition = $this->position + $length + $this->skip;
        $this->position = $tempPosition % sizeof($this->slots);
    }

    /**
     * Select $length slots, reverse them and put them back into the array.
     * @param $length int Length to use when reversing.
     */
    private function reverseSet(int $length): void {
        // Get set...
        $set = array_slice($this->slots, $this->position, $length);
        $initialPortionLength = sizeof($set);
        $wrappedPortionLength = $length - $initialPortionLength;
        $set = array_merge($set, array_slice($this->slots, 0, $wrappedPortionLength));

        // ...reverse...
        $set = array_reverse($set);

        // ...insert back over the sliced portion.
        $reversedInitialPortion = array_slice($set, 0, $initialPortionLength);
        $reversedWrappedPortion = array_slice($set, $initialPortionLength, $wrappedPortionLength);
        array_splice($this->slots, $this->position, $initialPortionLength, $reversedInitialPortion);
        if ($wrappedPortionLength !== 0) {
            array_splice($this->slots, 0, $wrappedPortionLength, $reversedWrappedPortion);
        }
    }
}
