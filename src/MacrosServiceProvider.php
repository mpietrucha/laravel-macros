<?php

namespace Mpietrucha\Macros;

use Illuminate\Support\ServiceProvider;
use Mpietrucha\Macros\Providers;

class MacrosServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Providers\Collection::loadIntoProvider();
        Providers\Stringable::loadIntoProvider();
    }

    public function register(): void
    {

    }
}
