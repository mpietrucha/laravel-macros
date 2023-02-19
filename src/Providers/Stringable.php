<?php

namespace Mpietrucha\Macros\Providers;

use Illuminate\Support\Stringable as Provider;
use Mpietrucha\Macros\ReflectionLoader;

class Stringable extends ReflectionLoader
{
    public static function provider(): string
    {
        return Provider::class;
    }
}
