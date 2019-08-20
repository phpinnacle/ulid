<?php
/**
 * This file is part of PHPinnacle/Ulid.
 *
 * (c) PHPinnacle Team <dev@phpinnacle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPinnacle;

use PHPinnacle\Ulid\Generator;
use PHPinnacle\Ulid\Value;

function ulid(\DateTimeInterface $time = null): Value
{
    return $time ? Generator::fromDateTime($time) : Generator::now();
}
