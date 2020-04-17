<?php

namespace App\Repositories;

use Exception;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogRepository extends Repository
{
    public function __construct(Log $log)
    {
        $this->model = $log;
    }

    public function write($content, $model, $action, $code)
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

        return $this->model->create($data);
    }
}
