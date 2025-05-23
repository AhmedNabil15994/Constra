<?php

namespace App\Modules\Frontend\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Entities\Page;

class FrontendComposer
{
    public $menues = [];

    public function __construct()
    {
        $this->menus =  Page::where([
            ['status',1],
            ['prefix' , '!=', null]
        ])->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menus' , $this->menus);
    }
}
