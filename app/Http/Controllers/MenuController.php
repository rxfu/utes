<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;

class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\MenuService  $menuService
     * @return void
     */
    public function __construct(MenuService $menuService)
    {
        $this->service = $menuService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list', Menu::class);

        $items = $this->service->getAll();

        return view('menu.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Menu::class);

        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MenuStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuStoreRequest $request)
    {
        $this->authorize('create', Menu::class);

        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('menus.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        $this->authorize('view', $menu);

        $item = $this->service->get($menu);

        return view('menu.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $this->authorize('update', $menu);

        $item = $this->service->get($menu);

        return view('menu.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MenuUpdateRequest  $request
     * @param  Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(MenuUpdateRequest $request, Menu $menu)
    {
        $this->authorize('update', $menu);

        if ($request->isMethod('put')) {

            $this->service->update($menu, $request->all());

            return redirect()->route('menus.show', $menu);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Menu $menu)
    {
        $this->authorize('delete', $menu);

        if ($request->isMethod('delete')) {

            $this->service->delete($menu);

            return redirect()->route('menus.index');
        }

        $this->error(405001);

        return back();
    }
}
