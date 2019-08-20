<?php
/**
 * This file is part of PHPinnacle/Ulid.
 *
 * (c) PHPinnacle Team <dev@phpinnacle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPinnacle\Ulid\Tests;

use PHPinnacle\Ulid\Encoding;
use PHPinnacle\Ulid\Exception;
use PHPinnacle\Ulid\Generator;

final class GeneratorTest extends UlidTest
{
    public function testGeneratesProperUlid(): void
    {
         self::assertSame(26, strlen(Generator::now()));
         self::assertRegExp('/[' . Encoding::CHARS . ']+/', (string) Generator::now());
    }

    public function testIncreaseRandomPartOnSameMillisecond(): void
    {
        $now = new \DateTimeImmutable();

        $a = Generator::fromDateTime($now);
        $b = Generator::fromDateTime($now);

        self::assertEquals($a->time(), $b->time());
        self::assertEquals(substr($a, 0, -1), substr($b, 0, -1));
        self::assertNotEquals((string) $a, (string) $b);
    }

    public function testCreateFromNegativeTimestamp(): void
    {
        self::expectException(Exception\TimeException::class);
        self::expectExceptionMessage("Time must be positive.");

        Generator::fromTimestamp(-1);
    }

    public function testCreateFromTimestampAfterEpochEnd(): void
    {
        self::expectException(Exception\TimeException::class);
        self::expectExceptionMessage("ULID does not support timestamps after +10889-08-02T05:31:50.655Z!");

        Generator::fromTimestamp(pow(2, 48));
    }

    public function testSortLexicographically(): void
    {
        $now = new \DateTimeImmutable();

        $a = Generator::fromDateTime($now);
        $b = Generator::fromDateTime($now->modify('+1 second'));
        $c = Generator::fromDateTime($now->modify('+2 second'));

        $list = [(string) $b, (string) $c, (string) $a];

        usort($list, 'strcmp');

        self::assertSame([(string) $a, (string) $b, (string) $c], $list);
    }
}
