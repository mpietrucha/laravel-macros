<?php

namespace Mpietrucha\Macros\Contracts;

use Illuminate\Support\Collection;

interface LoaderInterface
{
    public static function provider(): string;

    public static function loadIntoProvider(): void;

    public function provides(): Collection;
}
