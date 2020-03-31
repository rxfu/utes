<?php

namespace App\Exceptions;

use Exception;

class InternalException extends Exception
{
    private $exception;

    public function __construct($exception, $code = 500)
    {
        $this->exception = $exception;
        $message = '系统内部错误：' . $this->exception->getMessage();

        parent::__construct($message, $code);
    }

    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return back()->withDanger($this->getMessage())->withInput();
    }
}
