<?php
/**
 * This file is part of PHPinnacle/Ulid.
 *
 * (c) PHPinnacle Team <dev@phpinnacle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PHPinnacle\Ulid;

class Encoding
{
    const
        LENGTH = 32,
        INDEX  = 31,
        CHARS  = '0123456789ABCDEFGHJKMNPQRSTVWXYZ0',
        TABLE  = [
            '0' => 0,  '1' => 1,  '2' => 2,  '3' => 3,
            '4' => 4,  '5' => 5,  '6' => 6,  '7' => 7,
            '8' => 8,  '9' => 9,  'A' => 10, 'B' => 11,
            'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15,
            'G' => 16, 'H' => 17, 'J' => 18, 'K' => 19,
            'M' => 20, 'N' => 21, 'P' => 22, 'Q' => 23,
            'R' => 24, 'S' => 25, 'T' => 26, 'V' => 27,
            'W' => 28, 'X' => 29, 'Y' => 30, 'Z' => 31,
        ]
    ;

    const
        MAP_ENCODE = [
            'abcdefghijklmnopqrstuv',
            'ABCDEFGHJKMNPQRSTVWXYZ'
        ],
        MAP_DECODE = [
            'ABCDEFGHJKMNPQRSTVWXYZILO',
            'abcdefghijklmnopqrstuv110'
        ]
    ;

    /**
     * @param int $v
     *
     * @return string
     */
    public static function encode(int $v): string
    {
        return \strtr(\base_convert($v, 10, 32), self::MAP_ENCODE[0], self::MAP_ENCODE[1]);
    }

    /**
     * @param string $v
     *
     * @return string
     */
    public static function decode(string $v): string
    {
        return \base_convert(\strtr(\strtoupper($v), self::MAP_DECODE[0], self::MAP_DECODE[1]), 32, 10);
    }

    /**
     * @param string $str
     * @param int    $length
     *
     * @return string
     */
    public static function inc(string $str, int $length): string
    {
        while ($length-- >= 0) {
            $charIndex = self::TABLE[$str{$length}];

            $str = \substr_replace($str, self::CHARS[$charIndex + 1] ?? '0', $length, 1);

            if ($charIndex === self::INDEX) {
                continue;
            }

            return $str;
        }

        return $str;
    }
}
