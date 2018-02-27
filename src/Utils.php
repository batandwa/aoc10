<?php
namespace AOC10;

class Utils {
    public static function multipleXor(array $values): int {
        $gmped = array_map('gmp_init', $values);
        $initial = array_shift($gmped);
        $result = array_reduce($gmped, 'gmp_xor', $initial);

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
}
