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

class Value
{
    public const
        TIME_LENGTH = 10,
        RAND_LENGTH = 16,
        FULL_LENGTH = 26
    ;

    private const TIME_INDEX = 9;

    /**
     * @var string
     */
    private $value;

    /**
     * @var int
     */
    private $timestamp = 0;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public static function create(string $value): self
    {
        if (\strlen($value) !== self::FULL_LENGTH) {
            throw Exception\InvalidException::length();
        }

        return new self(\strtoupper($value));
    }

    /**
     * @return int
     */
    public function time(): int
    {
        if (!$this->timestamp) {
            for ($i = 0; $i < self::TIME_LENGTH; $i++) {
                $index = Encoding::TABLE[$this->value[self::TIME_INDEX - $i]];

                $this->timestamp += $index * \pow(Encoding::LENGTH, $i);
            }
        }

        return $this->timestamp;
    }

    /**
     * @return \DateTimeInterface
     * @throws \Exception
     */
    public function toDateTime(): \DateTimeInterface
    {
        $now = new \DateTimeImmutable();

        return $now->setTimestamp($this->time());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
