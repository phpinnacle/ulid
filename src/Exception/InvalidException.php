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

final class InvalidException extends UlidException
{
    /**
     * @return self
     */
    public static function length(): self
    {
        return new self('ULID string must be 26 chars!');
    }
}
