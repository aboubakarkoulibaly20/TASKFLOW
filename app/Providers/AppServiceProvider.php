<?php

namespace App\Providers;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url) {
        
        //[growcrm] - use bootstrap css for paginator
        Paginator::useBootstrap();

        //[grocrm] - custom views directory - used by imap email for embedded imaged, but can also be used for any temp blade filed 
        //Usage - view('temp::somefile');
        View::addNamespace('temp', path_storage('temp'));

        //[growcrm]
        $this->app->bind(Carbon::class, function (Container $container) {
            return new Carbon('now', 'Africa/Accra');
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
