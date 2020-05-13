<?php

namespace App\Services;

use App\Traits\Flash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Service
{
    use Flash;

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

    public function upload($file, $directory = 'files')
    {
        if ($file->isValid()) {
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $type = $file->getClientMimeType();
            $realPath = $file->getRealPath();
            $filename = Str::uuid() . '.' . $extension;
            $fileContents = file_get_contents($realPath);
            $path = $directory . '/' . date('Ymd') . '/' . $filename;

            if (Storage::disk('public')->put($path, $fileContents)) {
                $this->success(200008);

                return compact('name', 'type', 'path');
            } else {
                $this->error(500008);

                return false;
            }
        }

        $this->error(500007);

        return false;
    }
}
