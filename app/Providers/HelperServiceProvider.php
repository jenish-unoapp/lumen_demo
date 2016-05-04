<?php
/**
 * Created by PhpStorm.
 * User: jenish
 * Date: 30-04-2016
 * Time: AM 10:57
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        foreach (glob(__DIR__.'\..\Helpers\*.php') as $filename){
            /** @noinspection PhpIncludeInspection */
            require_once($filename);
        }
    }
}