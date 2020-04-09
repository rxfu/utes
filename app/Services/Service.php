<?php

namespace App\Services;

class Service
{
    protected $repository;

    public function get($id) {
        return $this->repository->find($id);
    }

    public function getAll() {
        return $this->repository->findAll();
    }

    public function store($data) {
        return $this->repository->save($data);
    }

    public function update($data) {
        return $this->repository->update($data);
    }

    public function delete($id) {
        return $this->repository->delete($id);
    }
}
