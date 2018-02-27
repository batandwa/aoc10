<?php
namespace AOC10;

class Utils {
    public static function multipleXor(array $values): int {
        $result = array_shift($values);
        foreach ($values as $num) {
            $result = gmp_xor($result, $num);
        }

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
