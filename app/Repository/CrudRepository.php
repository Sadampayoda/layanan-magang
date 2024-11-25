<?php

namespace App\Repository;

use App\Repository\Interface\CrudInterface;
use Illuminate\Database\Eloquent\Model;

class CrudRepository implements CrudInterface
{
    protected Model $model;




    public function setModel(string $model)
    {
        if (!class_exists($model)) {
            throw new \InvalidArgumentException("Model class $model not found.");
        }
        $this->model = new $model;
    }
    public function all()
    {
        return $this->model->all();
    }

    public function find(array $find)
    {
        return $this->model->where($find);
    }

    public function findId($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        $this->model->create($data);
    }

    public function update($data, $id)
    {
        $this->model->update($data, $id);
    }

    public function delete($id)
    {
        $this->model->find($id)->delete();
    }
}
