<?php

namespace App\Http\Controllers;

use App\Models\Menuitem;
use Illuminate\Http\Request;
use App\Services\MenuitemService;
use App\Http\Requests\MenuitemStoreRequest;
use App\Http\Requests\MenuitemUpdateRequest;

class MenuitemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\MenuitemService  $menuitemService
     * @return void
     */
    public function __construct(MenuitemService $menuitemService)
    {
        $this->service = $menuitemService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list', Menuitem::class);

        $items = $this->service->getAll();

        return view('menuitem.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Menuitem::class);

        return view('menuitem.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MenuitemStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuitemStoreRequest $request)
    {
        $this->authorize('create', Menuitem::class);

        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('menuitems.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function show(Menuitem $menuitem)
    {
        $this->authorize('view', $menuitem);

        $item = $this->service->get($menuitem);

        return view('menuitem.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function edit(Menuitem $menuitem)
    {
        $this->authorize('update', $menuitem);

        $item = $this->service->get($menuitem);

        return view('menuitem.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MenuitemUpdateRequest  $request
     * @param  Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function update(MenuitemUpdateRequest $request, Menuitem $menuitem)
    {
        $this->authorize('update', $menuitem);

        if ($request->isMethod('put')) {

            $this->service->update($menuitem, $request->all());

            return redirect()->route('menuitems.show', $menuitem);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Menuitem $menuitem)
    {
        $this->authorize('delete', $menuitem);

        if ($request->isMethod('delete')) {

            $this->service->delete($menuitem);

            return redirect()->route('menuitems.index');
        }

        $this->error(405001);

        return back();
    }
}
