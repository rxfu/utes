<?php

namespace App\Listeners;

use App\Services\LogService;
use App\Traits\Flash;

class LogLockout
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
        $this->_service->log(401002, $event->user, 'lockout');

        $this->warning(401002);
    }
}
