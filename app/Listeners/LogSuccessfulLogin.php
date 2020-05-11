<?php

namespace App\Listeners;

use App\Traits\Flash;
use App\Services\LogService;
use App\Services\SettingService;
use App\Services\UserService;

class LogSuccessfulLogin
{
    use Flash;

    private $_service;

    private $_userService;

    private $_settingService;

    /**
     * Create the event listener.
     *
     * @param \App\Services\LogService $service
     * @param \App\Services\UserService $userService
     * @param \App\Services\SettingService $settingService
     * @return void
     */
    public function __construct(LogService $service, UserService $userService, SettingService $settingService)
    {
        $this->_service = $service;
        $this->_userService = $userService;
        $this->_settingService = $settingService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;

        if (!$this->_userService->isSuperAdmin($user) && $this->_settingService->getSetting('maintenance')) {
            return redirect()->route('maintenance');
        } else {
            $this->_userService->successLogin($user);
        }

        $this->_service->log(200004, $event->user, 'login');

        $this->success(200004);
    }
}
