<?php

namespace App\Exceptions;

use App\Services\LogService;
use Exception;

class InvalidRequestException extends Exception
{
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
        $content = [
            'message' => $this->getMessage(),
        ];

        $log->log($content, $this->model, $this->action, $this->getCode());
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $message = '[' . $this->getCode() . '] ' . $this->getMessage();

        return back()->withDanger($message)->withInput();
    }
}
