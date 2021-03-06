<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UserExport;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\SettingService;
use App\Services\ApplicationService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    protected $settingService;

    protected $applicationService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\UserService  $userService
     * @param \App\Services\SettingService  $settingService
     * @param \App\Services\ApplicationService  $applicationService
     * @return void
     */
    public function __construct(UserService $userService, SettingService $settingService, ApplicationService $applicationService)
    {
        $this->authorizeResource(User::class, 'user');

        $this->service = $userService;
        $this->settingService = $settingService;
        $this->applicationService = $applicationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('user.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('users.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $item = $this->service->get($user);

        return view('user.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $item = $this->service->get($user);

        return view('user.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        if ($request->isMethod('put')) {

            $this->service->update($user, $request->all());

            return redirect()->route('users.show', $user);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($user);

            return redirect()->route('users.index');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Show the form for assigning the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function showRoleForm(User $user)
    {
        $this->authorize('role', $user);

        $item = $this->service->get($user);
        $assignedRoles = $this->service->getAssignedRoles($item);

        return view('user.role', compact('item', 'assignedRoles'));
    }

    /**
     * Assign the specified role in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function assignRole(Request $request, User $user)
    {
        $this->authorize('role', $user);

        if ($request->isMethod('post')) {

            $this->service->assignRole($user, $request->roles);

            return redirect()->route('users.index');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Show the form for assigning the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function showGroupForm(User $user)
    {
        $this->authorize('group', $user);

        $item = $this->service->get($user);
        $assignedGroups = $this->service->getAssignedGroups($item);

        return view('user.group', compact('item', 'assignedGroups'));
    }

    /**
     * Assign the specified role in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function assignGroup(Request $request, User $user)
    {
        $this->authorize('group', $user);

        if ($request->isMethod('post')) {

            $this->service->assignGroup($user, $request->groups);

            return redirect()->route('users.index');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Show the form for importing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showImportForm()
    {
        $this->authorize('import', User::class);

        return view('user.import');
    }

    /**
     * Import the specified users in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $this->authorize('import', User::class);

        if ($request->isMethod('post')) {

            $this->service->import(new UserImport($this->settingService), $request->file('import'));

            $this->success(200009);

            return redirect()->route('applications.index');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Show the form for drawing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDrawForm()
    {
        $this->authorize('draw', User::class);

        $year = $this->settingService->getSetting('year');

        $items = $this->service->getDrawingUsers($year, Auth::user());

        return view('user.draw', compact('items'));
    }

    /**
     * Draw the specified users in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function draw(Request $request)
    {
        $this->authorize('draw', User::class);

        if ($request->isMethod('put')) {

            $this->service->drawGroupAndSeq(Auth::user());

            $this->success(200011);

            return redirect()->route('users.draw');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Show the form for exporting the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showExportForm()
    {
        $this->authorize('import', User::class);

        $years = $this->applicationService->getYears();

        return view('user.export', compact('years'));
    }

    /**
     * Export the specified users in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $this->authorize('import', User::class);

        $this->success(200010);

        return $this->service->exportExcel(new UserExport($request->year), 'export.xlsx');
    }
}
