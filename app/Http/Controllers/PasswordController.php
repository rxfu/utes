<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordChangeRequest;

class PasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\UserService  $userService
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
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
        return view('password.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PasswordChangeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PasswordChangeRequest $request)
    {
        if ($request->isMethod('post')) {

            list($old, $new, $confirmed) = array_values($request->only('old_password', 'password', 'password_confirmation'));

            $this->service->changePassword($request->user(), $old, $new, $confirmed);

            $this->success(200006);

            return back();
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
    public function edit(User $password)
    {
        $item = $this->service->get($password);

        return view('password.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PasswordResetRequest  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordResetRequest $request, User $password)
    {
        if ($request->isMethod('put')) {

            list($new, $confirmed) = array_values($request->only('password', 'password_confirmation'));

            $this->service->resetPassword($password, $new, $confirmed);

            return redirect()->route('users.index');
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
}
