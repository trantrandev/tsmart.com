<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('money', function ($money, $suffix = 'đ') {
/*            return "<?php echo number_format($money, 0, ',', ',', '.'); ?>";*/
            return number_format($money, 0, ',', '.') . "{$suffix}";

        });

    }
}
