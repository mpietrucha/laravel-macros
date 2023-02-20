<?php

namespace Mpietrucha\Macros\Providers;

use Illuminate\Support\Stringable as Provider;
use Mpietrucha\Macros\ReflectionLoader;
use Closure;
use Mpietrucha\Support\Hash;

class Stringable extends ReflectionLoader
{
    public static function provider(): string
    {
        return Provider::class;
    }

    protected static function removeFirst(): Closure
    {
        return fn (string $replace) => $this->replaceFirst($replace, '');
    }

    protected static function removeLast(): Closure
    {
        return fn (string $replace) => $this->replaceFirst($replace, '');
    }

    protected static function toDatabaseField(): Closure
    {
        return fn () => $this->replace('\\', ' ')->snake()->lower();
    }

    protected static function md5(): Closure
    {
        return fn () => str(Hash::md5($this->toString()));
    }

    protected static function toLettersCollection(): Closure
    {
        return fn () => collect(str_split($this->toString()));
    }

    protected static function toNewLineCollection(): Closure
    {
        return fn () => $this->explode(PHP_EOL);
    }

    protected static function toDirectoryCollection(): Closure
    {
        return fn () => $this->explode(DIRECTORY_SEPARATOR);
    }

    protected static function toWordsCollection(): Closure
    {
        return fn () => $this->explode(' ');
    }

    protected static function toDotWordsCollection(): Closure
    {
        return fn () => $this->explode('.');
    }
}
