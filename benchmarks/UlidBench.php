<?php

namespace PHPinnacle\Ulid\Bench;

use PhpBench\Benchmark\Metadata\Annotations\AfterMethods;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PHPinnacle\Ulid\Generator;

/**
 * @BeforeMethods({"init"})
 * @AfterMethods({"clear"})
 */
abstract class UlidBench
{
    public function init()
    {
    }

    public function clear()
    {
    }
}
