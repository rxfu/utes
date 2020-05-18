<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScorepeerStoreRequest;
use App\Http\Requests\ScorepeerUpdateRequest;
use App\Models\Scorepeer;
use App\Models\User;
use App\Services\ScorepeerService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ScorepeerController extends Controller
{
    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\ScorepeerService  $scorepeerService
     * @param \App\Services\UserService  $userService
     * @return void
     */
    public function __construct(ScorepeerService $scorepeerService, UserService $userService)
    {
        $this->authorizeResource(Scorepeer::class, 'scorepeer');

        $this->service = $scorepeerService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('scorepeer.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $item = $this->userService->get($user);
        $assignedTeachers = $this->service->getAssignedTeachers($item);

        return view('scorepeer.create', compact('item', 'assignedTeachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ScorepeerStoreRequest  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(ScorepeerStoreRequest $request, User $user)
    {
        if ($request->isMethod('post')) {

            $this->service->assignTeacher($user, $request->teachers);

            return redirect()->route('scorepeers.teacher');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Scorepeer  $scorepeer
     * @return \Illuminate\Http\Response
     */
    public function show(Scorepeer $scorepeer)
    {
        $item = $this->service->get($scorepeer);

        return view('scorepeer.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Scorepeer  $scorepeer
     * @return \Illuminate\Http\Response
     */
    public function edit(Scorepeer $scorepeer)
    {
        $item = $this->service->get($scorepeer);

        return view('scorepeer.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ScorepeerUpdateRequest  $request
     * @param  Scorepeer  $scorepeer
     * @return \Illuminate\Http\Response
     */
    public function update(ScorepeerUpdateRequest $request, Scorepeer $scorepeer)
    {
        if ($request->isMethod('put')) {

            $this->service->update($scorepeer, $request->all());

            return redirect()->route('scorepeers.show', $scorepeer);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Scorepeer  $scorepeer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Scorepeer $scorepeer)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($scorepeer);

            return redirect()->route('scorepeers.index');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display a listing of the resource assigned teachers.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function list(User $user)
    {
        $this->authorize('list', Scorepeer::class);

        $items = $this->userService->getUsersByRole('peer');

        return view('scorepeer.teacher', compact('items'));
    }
}
