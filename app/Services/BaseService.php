<?php 

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseService
{
    protected $repository;

    function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function getById(int $id): ?Model
    {
        return $this->repository->getById($id);
    }

    public function create(array $data): ?Model
    {
        return $this->repository->create($data);
    }

    public function update(array $data, Model $model): ?Model
    {
        return $this->repository->update($data, $model);
    }

    public function delete(Model $model): bool
    {
        return $this->repository->delete($model);
    }
}