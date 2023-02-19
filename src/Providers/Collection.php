<?php

namespace Mpietrucha\Macros\Providers;

use Illuminate\Support\Collection as Provider;
use Mpietrucha\Macros\ReflectionLoader;

class Collection extends ReflectionLoader
{
    public static function provider(): string
    {
        return Provider::class;
    }
}
