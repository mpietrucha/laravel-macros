<?php

namespace Mpietrucha\Macros\Providers;

use Illuminate\Support\Facades\File as Provider;
use Mpietrucha\Macros\ReflectionLoader;
use Closure;

class File extends ReflectionLoader
{
    public static function provider(): string
    {
        return Provider::class;
    }

    protected static function collectAllFiles(): Closure
    {
        return fn (string $path) => collect($this->allFiles($path));
    }

    protected static function collectFiles(): Closure
    {
        return fn (string $path) => collect($this->files($path));
    }
}
