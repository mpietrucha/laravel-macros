<?php

namespace Mpietrucha\Macros;

use Mpietrucha\Contracts\LoaderInterface;
use Illuminate\Support\Collection;

class ReflectionLoader implements LoaderInterface
{
    public static function loadIntoProvider(): void
    {
        with(new static)->providers()->each(fn (Closure $macro, string $name) => static::provider()::macro($name, $macro));
    }

    public function provides(): Collection
    {

    }
}
