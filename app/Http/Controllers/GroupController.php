<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupStoreRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\GroupService  $groupService
     * @return void
     */
    public function __construct(GroupService $groupService)
    {
        $this->authorizeResource(Group::class, 'group');

        $this->service = $groupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('group.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GroupStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupStoreRequest $request)
    {
        if ($request->isMethod('post')) {
    
            $item = $this->service->store($request->all());

            return redirect()->route('groups.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $item = $this->service->get($group);

        return view('group.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $item = $this->service->get($group);

        return view('group.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GroupUpdateRequest  $request
     * @param  Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(GroupUpdateRequest $request, Group $group)
    {
        if ($request->isMethod('put')) {
    
            $this->service->update($group, $request->all());

            return redirect()->route('groups.show', $group);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Group $group)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($group);

            return redirect()->route('groups.index');
        }

        $this->error(405001);

        return back();
    }
}
