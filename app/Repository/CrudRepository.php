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
    public function all(array $relational = [])
    {
        return ($relational) ? $this->model->with($relational)->get()
        : $this->model->all();
    }

    public function find(array $find, array $relational = [])
    {
        return ($relational) ? $this->model->with($relational)->where($find)->get()
        : $this->model->where($find)->get();
    }

    public function findId($id, array $relational = [])
    {
        return ($relational) ? $this->model->with($relational)->find($id)
        : $this->model->find($id);
    }

    public function create($data)
    {
        $this->model->create($data);
    }

    public function update($data, $id)
    {
        $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        $this->model->find($id)->delete();
    }
}
