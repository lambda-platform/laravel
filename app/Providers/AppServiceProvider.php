<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $lambdaConfig = json_decode(file_get_contents(base_path().DIRECTORY_SEPARATOR."lambda.json"), true);
//        $lambdaConfig["app"] = "lambda";
//        config(['lambda'=>$lambdaConfig]);
        //
    }
}
