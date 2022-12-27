<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

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
        Paginator::useBootstrap();
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^(\w+\s)*\w+$/u', $value);
        });
        Validator::extend('rollno_pattern', function ($attribute, $value) {
            return preg_match('/^([1-5]+)([CS|CT]+)([-]+)([0-9]{1,4})$/', $value);
        });
        Validator::extend('study_year_pattern', function($attribute, $value){
            return preg_match('/^20[0-9]{2}$/',$value);
        });
    }
}
