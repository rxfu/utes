<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('change');

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
        $this->authorize('change');

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
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $password)
    {
        $this->authorize('reset', $password);

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
        $this->authorize('reset', $password);

        if ($request->isMethod('put')) {

            list($new, $confirmed) = array_values($request->only('password', 'password_confirmation'));

            $this->service->resetPassword($password, $new, $confirmed);

            return redirect()->route('users.index');
        }

        $this->error(405001);

        return back();
    }
}
