<?php

namespace App\Providers;

use Exception;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try{
            info(request()->all());
            if(config('app.force_https') || gss('force_https') || request()->force_https){
                \URL::forceScheme('https');
            }

            $wncms = wncms();
            view()->share('wncms', $wncms);
            //檢查是否已安裝系統
            if (wncms_is_installed()) {
                $website = wncms()->website()->get();
                view()->share('website', $website);
            }else{
                // redirect to installation guide
            }
    
            // TODO: Allow to use theme paginator
            Paginator::useBootstrap();
        }catch(Exception $e){
            logger()->error($e);
        }

    }
}
