<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\MenuitemService;

class MenuComposer
{
    private $menuitems;

    public function __construct(MenuitemService $menuitems)
    {
        $this->menuitems = $menuitems;
    }
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $menuitems = $this->menuitems;

        $view->with(compact('menuitems'));
    }
}
