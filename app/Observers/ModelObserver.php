<?php

namespace App\Observers;

use App\Services\LogService;

class ModelObserver
{
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
    }
}
