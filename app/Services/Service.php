<?php

namespace App\Services;

class Service
{
    protected $repository;

    public function get($model)
    {
        return $this->repository->find($model->getKey());
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function store($data)
    {
        return $this->repository->save($data);
    }

    public function update($model, $data)
    {
        return $this->repository->update($model->getKey(), $data);
    }

    public function delete($model)
    {
        return $this->repository->delete($model->getKey());
    }
}
