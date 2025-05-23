<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $modules = config("modules.modules");
        foreach ($modules as $module) {
            if(is_dir(base_path('app/Modules/'.$module.'/Resources/Views'))) {
                $this->loadViewsFrom(base_path('app/Modules/'.$module.'/Resources/Views'), $module);
            }
            if(is_dir(base_path('app/Modules/'.$module.'/Resources/Lang'))) {
                $this->loadTranslationsFrom(base_path('app/Modules/'.$module.'/Resources/Lang'), $module);
            }
            if(is_dir(base_path('app/Modules/'.$module.'/Config'))) {
                $this->mergeConfigFrom( base_path('app/Modules/'.$module.'/Config/'.$module.'.php') , lcfirst($module));
            }
            if(is_dir(base_path('app/Modules/'.$module.'/Database/Migrations'))) {
                $this->loadMigrationsFrom(base_path('app/Modules/'.$module.'/Database/Migrations'));
            }
            if(file_exists(base_path('app/Modules/'.$module.'/Http/routes.php'))) {
                $this->loadRoutesFrom( base_path('app/Modules/'.$module.'/Http/routes.php'));
            }
            if(is_dir(base_path('app/Modules/'.$module.'/ViewComposers')) && file_exists(base_path("app/Modules/".$module."/ViewComposers/".$module."Composer.php"))) {
                $moduleComposer = \Helper::getClassesInNamespace(base_path('app/Modules/'.$module.'/ViewComposers'));
                foreach($moduleComposer as $one){
                    View::composer(
                        '*', "App\\Modules\\".$module."\\ViewComposers\\".$one
                    );
                }
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
