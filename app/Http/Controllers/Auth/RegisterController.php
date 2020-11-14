<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Arr;
use App\Services\UserService;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Services\ApplicationService;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $applicationService;

    protected $settingService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService, ApplicationService $applicationService, SettingService $settingService)
    {
        $this->middleware('guest');

        $this->service = $userService;
        $this->applicationService = $applicationService;
        $this->settingService = $settingService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'uid' => ['required', 'string', 'size:8', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric'],
            'reason' => ['required_if:is_applied_expert,0'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        foreach (range(1, 3) as $id) {
            if (isset($data['file' . $id])) {
                $files[$id] = $this->applicationService->upload($data['file' . $id], $data['username']);
            }
        }

        $user = $this->service->store([
            'uid' => $data['uid'],
            'username' => $data['name'] . $data['uid'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone' => $data['phone'],
            'gender_id' => $data['gender_id'],
            'department_id' => $data['department_id'],
        ]);

        $this->service->assignRole($user, 2);

        $file = isset($files) ? implode(';', Arr::pluck($files, 'path')) : null;

        $application = [
            'year' => $this->settingService->getSetting('year'),
            'user_id' => $user->id,
            'degree_id' => $data['degree_id'],
            'title_id' => $data['title_id'],
            'applied_title_id' => $data['applied_title_id'],
            'is_applied_expert' => $data['is_applied_expert'],
            'reason' => ($data['is_applied_expert'] == 1) ? 0 : $data['reason'],
            'has_course' => $data['has_course'],
            'course' => $data['course'],
            'subject_id' => $data['subject_id'],
            'remark' => $data['remark'],
            'file' => $file,
        ];

        $this->applicationService->store($application);

        return $user;
    }
}
