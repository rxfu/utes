<?php

namespace App\Observers;

use App\Services\LogService;
use App\Traits\Flash;

class ModelObserver
{
    use Flash;

    protected $service;

    public function __construct(LogService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the Model "created" event.
     *
     * @param  $model
     * @return void
     */
    public function created($model)
    {
        $this->service->log(200001, $model, __FUNCTION__, $model->getAttributes());

        $this->success(200001);
    }

    /**
     * Handle the Model "updating" event.
     *
     * @param  $model
     * @return void
     */
    public function updating($model)
    {
        $this->service->log(200004, $model, __FUNCTION__, $model->getOriginal());

        // $this->info(100001);
    }

    /**
     * Handle the Model "updated" event.
     *
     * @param  $model
     * @return void
     */
    public function updated($model)
    {
        $this->service->log(200002, $model, __FUNCTION__, $model->getAttributes());

        $this->success(200002);
    }

    /**
     * Handle the Model "deleting" event.
     *
     * @param  $model
     * @return void
     */
    public function deleting($model)
    {
        $this->service->log(200003, $model, __FUNCTION__, $model->getAttributes());

        $this->success(200003);
    }
}
