<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\RoleService  $roleService
     * @return void
     */
    public function __construct(RoleService $roleService)
    {
        $this->authorizeResource(Role::class, 'role');

        $this->service = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('role.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('roles.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $item = $this->service->get($role);

        return view('role.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $item = $this->service->get($role);

        return view('role.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleUpdateRequest  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        if ($request->isMethod('put')) {

            $this->service->update($role, $request->all());

            return redirect()->route('roles.show', $role);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($role);

            return redirect()->route('roles.index');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Show the form for assigning the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function showPermissionForm(Role $role)
    {
        $this->authorize('permission', $role);

        $item = $this->service->get($role);
        $assignedPermissions = $this->service->getAssignedPermissions($role);

        return view('role.permission', compact('item', 'assignedPermissions'));
    }

    /**
     * Assign the specified permission in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function assignPermission(Request $request, Role $role)
    {
        $this->authorize('permission', $role);

        if ($request->isMethod('post')) {

            $this->service->assignPermission($role, $request->permissions);

            return redirect()->route('roles.index');
        }

        $this->error(405001);

        return back();
    }
}
