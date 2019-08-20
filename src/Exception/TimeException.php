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

namespace PHPinnacle\Ulid\Exception;

final class TimeException extends UlidException
{
    /**
     * @return self
     */
    public static function maxValue(): self
    {
        return new self("ULID does not support timestamps after +10889-08-02T05:31:50.655Z!");
    }

    /**
     * @return self
     */
    public static function minValue(): self
    {
        return new self("Time must be positive.");
    }
}
