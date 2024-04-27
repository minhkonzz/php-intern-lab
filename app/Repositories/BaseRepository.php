<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
    protected $model;

    function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function create(array $data): ?Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, Model $model): ?Model
    {
        $model->update($data);
        return $model;
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }   
}