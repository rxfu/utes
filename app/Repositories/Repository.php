<?php

namespace App\Repositories;

use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;
use App\Exceptions\InvalidRequestException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class Repository
{
    protected $model;

    public function getTable()
    {
        return $this->model->getTable();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function find($id, $trashed = false)
    {
        try {
            if ($trashed) {
                return $this->model->withTrashed()->findOrFail($id);
            }

            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new InternalException($e, $this->getModel(), 'find');
        }
    }

    public function findAll($order = 'id', $direction = 'asc', $trashed = false)
    {
        $query = $this->model->orderBy($order, $direction);

        if ($trashed) {
            $query = $query->withTrashed();
        }

        return $query->get();
    }

    public function findWith($relations, $order = 'id', $direction = 'asc', $trashed = false) {
        $relations = is_array($relations) ? $relations : [$relations];
        
        $query = $this->model->with($relations)->orderBy($order, $direction);

        if ($trashed) {
            $query = $query->withTrashed();
        }

        return $query->get();
    }

    public function save($attributes)
    {
        try {
            $attributes = is_array($attributes) ? $attributes : [$attributes];
            $object = $this->model->create($attributes);

            if (!$object) {
                throw new InvalidRequestException(400001, $this->getModel(), 'save');
            } else {
                return $object;
            }
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), 'save');
        }
    }

    public function update($id, $attributes)
    {
        $object = $this->find($id);
        $attributes = is_array($attributes) ? $attributes : [$attributes];

        if (false === $object->update($attributes)) {
            throw new InvalidRequestException(400002, $this->getModel(), 'update');
        }

        return $object;
    }

    public function delete($id, $force = false)
    {
        $object = $this->find($id);
        $success =  $force ? $object->forceDelete() : $object->delete();

        if (is_null($success) || (false === $success)) {
            throw new InvalidRequestException(400003, $this->getModel(), 'delete');
        }

        return $success;
    }

    public function deleteAll($ids, $force = false)
    {
        $ids = is_array($ids) ? $ids : [$ids];
        $count = 0;

        foreach ($ids as $id) {
            if ($this->delete($id, $force)) {
                $count++;
            }
        }

        return $count;
    }

    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array([new static(), $method], $arguments);
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->model, $method], $arguments);
    }
}
