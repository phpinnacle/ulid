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

use PHPinnacle\Ulid\Exception;
use PHPinnacle\Ulid\Value;

final class ValueTest extends UlidTest
{
    public function testCreateFromString(): void
    {
        self::assertEquals('01AN4Z07BY79KA1307SR9X4MV3', (string) Value::create('01AN4Z07BY79KA1307SR9X4MV3'));
    }

    public function testCreatesFromInvalidString(): void
    {
        self::expectException(Exception\InvalidException::class);

        Value::create('invalid');
    }

    public function testTimestamp(): void
    {
        self::assertEquals(1561622862, Value::create('0001EH8YAEP8CXP4AMWCHHDBHJ')->time());
    }

    public function testDatetime(): void
    {
        $ulid = Value::create('0001EH8YAEP8CXP4AMWCHHDBHJ');

        self::assertEquals(1561622862, $ulid->toDateTime()->getTimestamp());
    }
}
