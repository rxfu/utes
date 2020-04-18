<?php

namespace App\Services;

use Exception;
use App\Repositories\LogRepository;
use Illuminate\Support\Facades\Auth;

class LogService extends Service
{
    public function __construct(LogRepository $logs)
    {
        $this->repository = $logs;
    }

    public function log($code, $model, $action, $data = null)
    {
        $content = [
            'code' => $code,
            'message' => config('setting.code')[(int) $code],
        ];

        if (!is_null($data)) {
            $content = array_merge($content, [
                'data' => $data,
            ]);
        }

        $this->repository->write($content, $model, $action, $code);
    }

    public function logException($exception, $model, $action)
    {
        $content = [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'exception' => class_basename($exception),
        ];

        $this->repository->write($content, $model, $action, $exception->getCode());
    }

    public function getAll()
    {
        return $this->repository->findAll('created_at', 'desc');
    }
}
