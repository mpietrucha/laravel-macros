<?php

namespace Mpietrucha\Macros;

use ReflectionMethod;
use Mpietrucha\Macros\Contracts\LoaderInterface;
use Illuminate\Support\Collection;
use Mpietrucha\Reflector\Reflector;
use Closure;

abstract class ReflectionLoader implements LoaderInterface
{
    public static function loadIntoProvider(): void
    {
        with(new static)->providers()->each(fn (Closure $macro, string $name) => static::provider()::macro($name, $macro));
    }

    public function provides(): Collection
    {
        return Reflector::create(self::class)
            ->filter($this->filterProtectedStaticMacrosReturningClosure(...))
            ->mapWithKeys($this->mapToMacroNameClosureArray(...));
    }

    protected function filterProtectedStaticMacrosReturningClosure(ReflectionMethod $method): bool
    {
        if (! $method->getReturnType()?->getName() === Closure::class) {
            return false;
        }

        return $method->isStatic() && $method->isProtected();
    }

    protected function mapToMacroNameClosureArray(ReflectionMethod $method): array
    {
        $method = $method->getName();

        return [$method => $this->$method()];
    }
}
