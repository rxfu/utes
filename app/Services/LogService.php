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

    public function log($content, $model, $action, $code)
    {
        $modelName = class_basename($model);
        $modelId = $model->getKey() ?: '';
        $content = is_array($content) ? $content : [$content];

        $data = [
            'user_id' => Auth::id(),
            'ip' => request()->ip(),
            'code' => $code,
            'path' => request()->path(),
            'method' => request()->method(),
            'action' => $action,
            'model' => $modelName,
            'model_id' => $modelId,
            'content' => $content,
        ];

        if ($object = $this->repository->create($data)) {
            return $object;
        } else {
            throw new Exception('日志记录错误');
        }
    }
}
