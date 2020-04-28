<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * NUHSAs válidos:
     * AN1000038583
     * AN0326435212
     * AN0408397178
     * AN0404408155
     * AN0415331870
     *
     * NUHSA no válido:
     * AN0415531870
     *
     * @return void
     */
    public function boot()
    {
        //

        Schema::defaultStringLength(191);
        $this->commands([
            \App\Console\Commands\ImportContacts::class
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
