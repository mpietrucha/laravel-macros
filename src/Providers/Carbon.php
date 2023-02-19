<?php

namespace Mpietrucha\Macros\Providers;

use Carbon\Carbon as Provider;
use Mpietrucha\Macros\ReflectionLoader;

class Carbon extends ReflectionLoader
{
    public static function provider(): string
    {
        return Provider::class;
    }
}
