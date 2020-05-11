<?php

namespace App\Listeners;

use App\Traits\Flash;
use App\Services\LogService;

class LogSuccessfulLogin
{
    use Flash;

    private $_service;

    /**
     * Create the event listener.
     *
     * @param \App\Services\LogService $service
     * @return void
     */
    public function __construct(LogService $service)
    {
        $this->_service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->_service->log(200004, $event->user, 'login');

        $this->success(200004);
    }
}
