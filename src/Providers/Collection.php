<?php

namespace Mpietrucha\Macros\Providers;

use Illuminate\Support\Collection as Provider;
use Mpietrucha\Macros\ReflectionLoader;
use Closure;

class Collection extends ReflectionLoader
{
    public static function provider(): string
    {
        return Provider::class;
    }

    protected static function toWords(): Closure
    {
        return fn () => str($this->join(' '));
    }

    protected static function toWord(): Closure
    {
        return fn () => str($this->join(''));
    }

    protected static function toCommaWords(): Closure
    {
        return fn () => str($this->join(', '));
    }

    protected static function toCommaWord(): Closure
    {
        return fn () => str($this->join(','));
    }

    protected static function toDotWord(): Closure
    {
        return fn () => str($this->join('.'));
    }

    protected static function toNewLineWords(): Closure
    {
        return fn (int $times = 1, ?string $prepend = null, ?string $append = null) => str($this->join(Collection::times($times)->map(fn () => $prepend . PHP_EOL . $append)->toWord()));
    }

    protected static function mapOnArrayTo(): Closure
    {
        return function (Closure $to) {
            return $this->map(fn (mixed $i) => Types::array($i) ? ConditionalResolver::toValue($to, $i, spreadParams: false) : $i);
        };
    }

    protected static function recursive(): Closure
    {
        return fn () => $this->mapOnArrayTo(fn (array $i) => collect($i)->recursive());
    }

    protected static function ofObjects(): Closure
    {
        return fn () => $this->mapOnArrayTo(fn (array $i) => (object) $i);
    }

    protected static function toObject(): Closure
    {
        return fn () => (object) [...$this];
    }

    protected static function toStringable(): Closure
    {
        return fn () => $this->map(fn (string $i) => str($i));
    }

    protected static function onlySorted(): Closure
    {
        return function (string ...$keys) {
            $keys = collect($keys);

            return $this->only($keys->values())->sortKeysUsing(fn (string $keyA, string $keyB) => $keys->search($keyA) <=> $keys->search($keyB));
        };
    }

    protected static function clone(): Closure
    {
        return fn () => clone $this;
    }

    protected static function withoutFirst(): Closure
    {
        return fn () => $this->splice(1);
    }

    protected static function withoutLast(): Closure
    {
        return fn () => $this->splice(0, $this->count() - 1);
    }

    protected static function whenCount(): Closure
    {
        return fn (Closure|int $count, Closure $callback) => $this->when(
            ConditionalResolver::toValue($count, $this) == (Types::int($count) ? $this->count() : true),
            $callback
        );
    }

    protected static function next(): Closure
    {
        return function (Closure $handler) {
            $index = $this->search($handler);

            if ($index === false) {
                return $this->first();
            }

            $index = $this->keys()->search($index);

            if ($index + 1 === $this->count()) {
                return $this->first();
            }

            return $this->values()->get($index + 1);
        };
    }
}
