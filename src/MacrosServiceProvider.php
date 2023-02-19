<?php

namespace Mpietrucha\Macros;

use Illuminate\Support\ServiceProvider;
use Mpietrucha\Macros\Providers;

class MacrosServiceProvider
{
    public function boot(): void
    {
        Providers\Carbon::loadIntoProvider();
        Providers\Collection::loadIntoProvider();
        Providers\Eloquent::loadIntoProvider();
        Providers\Stringable::loadIntoProvider();
    }

    public function register(): void
    {

    }
}
