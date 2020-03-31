<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\MenuRepository;

class MenuComposer
{
    private $menus;

    public function __construct(MenuRepository $menus)
    {
        $this->menus = $menus;
    }
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $menus = $this->menus;

        $view->with(compact('menus'));
    }
}
