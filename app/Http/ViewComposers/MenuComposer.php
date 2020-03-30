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
        $menu_main = $this->menus->getMenu('main');
        $menu_nav = $this->menus->getMenu('navigation');

        $view->with(compact('menu_nav', 'menu_main'));
    }
}
