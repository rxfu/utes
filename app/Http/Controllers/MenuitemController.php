<?php

namespace App\Http\Controllers;

use App\Services\MenuitemService;
use Illuminate\Http\Request;

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
        return view('menuitem.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $item = $this->service->store($request->all());

            return redirect()->route('menuitems.show', $item->id);
        }

        return back()->withDanger('提交方法错误');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->service->get($id);

        return view('menuitem.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->service->get($id);

        return view('menuitem.edit', compact('item'))->withSuccess('保存数据成功');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('put'))
        {
            $this->service->update($id, $request->all());

            return redirect()->route('menuitems.show', $id)->withSuccess('更新数据成功');
        }
        
        return back()->withDanger('提交方法错误');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()->route('menuitems.index')->withSuccess('删除数据成功');
    }
}
