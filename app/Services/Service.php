<?php

namespace App\Services;

use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Traits\Flash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Exceptions\LaravelExcelException;
use Maatwebsite\Excel\Facades\Excel;

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
                throw new InvalidRequestException(500008, $this->repository->getModel(), __FUNCTION__);
            }
        }

        throw new InvalidRequestException(500007, $this->repository->getModel(), __FUNCTION__);
    }

    public function import($import, $file)
    {
        try {
            Excel::import($import, $file);
        } catch (LaravelExcelException $e) {
            throw new InternalException($e, $this->repository->getModel(), __FUNCTION__);
        }
    }

    public function exportExcel($export, $file = 'untitle.xlsx')
    {
        try {
            return Excel::download($export, $file);
        } catch (LaravelExcelException $e) {
            throw new InternalException($e, $this->repository->getModel(), __FUNCTION__);
        }
    }
}
