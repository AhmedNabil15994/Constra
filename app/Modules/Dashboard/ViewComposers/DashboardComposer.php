<?php

namespace App\Modules\Dashboard\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Entities\Category;

class DashboardComposer
{
    public $available_locales = [];
    public $menues = [];

    public function __construct()
    {
        $this->available_locales =  config('modules.available_locales');
        $this->menus =  Category::where([
            ['status',1],
            ['parent_id',null],
            ['prefix' , '!=', null]
        ]);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('available_locales' , $this->available_locales);
        $view->with('menus' , $this->menus);
    }
}
