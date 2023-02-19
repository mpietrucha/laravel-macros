<?php

namespace Mpietrucha\Macros\Providers;

use Illuminate\Database\Eloquent\Builder;
use Mpietrucha\Macros\ReflectionLoader;

class Eloquent extends ReflectionLoader
{
    public static function provider(): string
    {
        return Builder::class;
    }
}
