<?php

namespace PHPinnacle\Ulid\Bench;

use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use PHPinnacle\Ulid\Generator;

class GeneratorBench extends UlidBench
{
    /**
     * @Revs(10000)
     * @Iterations(10)
     */
    public function benchNow(): void
    {
        Generator::now()->time();
    }
}
