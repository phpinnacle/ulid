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

class Generator
{
    private const TIME_MAX = 281474976710655; // pow(2, 48) - 1

    /**
     * @var int
     */
    private static $lastTime = 0;

    /**
     * @var string
     */
    private static $lastRand = '';

    /**
     * @return Value
     */
    public static function now(): Value
    {
        return self::fromTimestamp((int) floor(\microtime(true) / 1000));
    }

    /**
     * @param \DateTimeInterface $time
     *
     * @return Value
     */
    public static function fromDateTime(\DateTimeInterface $time): Value
    {
        return self::fromTimestamp((int) ($time->getTimestamp() . $time->format('v')));
    }

    /**
     * @param int $time
     *
     * @return Value
     */
    public static function fromTimestamp(int $time): Value
    {
        $rand = self::$lastTime === $time ? Encoding::inc(self::$lastRand, Value::RAND_LENGTH) : self::randPart();

        return new Value(self::timePart($time) . $rand);
    }

    /**
     * @param int $time
     *
     * @return string
     */
    private static function timePart(int $time): string
    {
        if ($time > self::TIME_MAX) {
            throw Exception\TimeException::maxValue();
        }

        if ($time < 0) {
            throw Exception\TimeException::minValue();
        }

        self::$lastTime = $time;

        $str = '';

        for ($i = Value::TIME_LENGTH; $i > 0; $i--) {
            $mod = $time % Encoding::LENGTH;
            $str = Encoding::CHARS[$mod] . $str;
            $time = ($time - $mod) / Encoding::LENGTH;
        }

        return $str;
    }

    /**
     * @return string
     */
    private static function randPart(): string
    {
        $str = '';

        for ($i = Value::RAND_LENGTH; $i > 0; $i--) {
            $rnd = \random_int(1, Encoding::LENGTH) - 1;
            $str = Encoding::CHARS[$rnd] . $str;
        }

        self::$lastRand = $str;

        return $str;
    }
}
