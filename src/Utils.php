<?php
namespace AOC10;

class Utils {
    public static function multipleXor(array $values): int {
        $initial = array_shift($values);
        $result = array_reduce($values, 'gmp_xor', $initial);
        return gmp_intval($result);
    }

    public static function parseLengths(string $sequence): array {
        $result = [];
        for ($i = 0; $i < strlen($sequence); $i++) {
            $result[] = ord($sequence[$i]);
        }

        return $result;
    }

    public static function addSuffix(array $lengths): array {
        return array_merge($lengths, [17, 31, 73, 47, 23]);
    }

    /**
     * Reduce each chunk to a single decimal value using XOR then
     * convert the result to a hexadecimal value.
     * @param array $chunks Chunks to be reduced.
     * @return array
     */
    public static function chunkToHex(array $chunks): array {
        $hexed = [];
        foreach ($chunks as $chunk) {
            $xorred = Utils::multipleXor($chunk);
            $hexed[] = str_pad(dechex($xorred), 2, '0', STR_PAD_LEFT);
        }

        return $hexed;
    }
}
