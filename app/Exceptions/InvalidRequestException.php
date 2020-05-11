<?php

namespace App\Exceptions;

use App\Services\LogService;
use App\Traits\Flash;
use Exception;

class InvalidRequestException extends Exception
{
    use Flash;

    protected $model;

    protected $action;

    public function __construct($code, $model, $action)
    {
        $this->model = $model;
        $this->action = $action;
        $message = config('setting.code')[(int) $code];

        parent::__construct($message, $code);
    }

    /**
     * Report or log an exception.
     *
     * @param App\Services\LogService $log
     * @return void
     */
    public function report(LogService $log)
    {
        $log->log($this->getCode(), $this->model, $this->action);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $this->error($this->getCode());

        return back()->withInput();
    }
}
