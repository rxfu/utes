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
        return class_basename($this->model);
    }

    public function find($id, $trashed = false)
    {
        try {
            if ($trashed) {
                return $this->model->withTrashed()->findOrFail($id);
            }

            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new InternalException($e);
        }
    }

    public function getAll($order = 'id', $direction = 'asc')
    {
        return $this->object->orderBy($order, $direction)->get();
    }

    public function store($attributes)
    {
        try {
            $attributes = is_array($attributes) ? $attributes : [$attributes];
            $object = $this->object->create($attributes);

            if (!$object) {
                throw new InvalidRequestException($this->getModel() . ' 对象创建失败', $this->getObject(), 'store');
            } else {
                return $object;
            }
        } catch (QueryException $e) {
            throw new InternalException($this->getModel() . ' 对象创建错误', $this->getObject(), 'store', $e);
        }
    }

    public function update($id, $attributes)
    {
        $object = $this->get($id);
        $attributes = is_array($attributes) ? $attributes : [$attributes];

        if (false === $object->update($attributes)) {
            throw new InvalidRequestException($this->getModel() . ': ' . $id . ' 对象更新失败', $this->getObject(), 'update');
        }

        return $object;
    }

    public function delete($id, $force = false)
    {
        $object = $this->get($id);
        $success =  $force ? $object->forceDelete() : $object->delete();

        if (is_null($success) || (false === $success)) {
            throw new InvalidRequestException($this->getModel() . ': ' . $id . ' 对象删除失败', $this->getObject(), 'delete');
        }
    }

    public function deleteAll($ids, $force = false)
    {
        $ids = is_array($ids) ? $ids : [$ids];

        foreach ($ids as $id) {
            $this->delete($id, $force);
        }
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
