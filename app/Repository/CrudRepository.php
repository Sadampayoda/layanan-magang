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
    public function all(array $relational = [], $orderBy = 'ASC',$coloms = 'id')
    {
        return ($relational) ? $this->model->with($relational)->orderBy($coloms,$orderBy)->get()
        : $this->model->orderBy($coloms,$orderBy)->get();
    }

    public function find( $key, $value, array $relational = [],$orderBy='ASC',  $coloms= 'id')
    {
        return ($relational) ? $this->model->with($relational)->where($key,$value)->orderBy($coloms,$orderBy)->get()
        : $this->model->where($key,$value)->orderBy($coloms,$orderBy)->get();
    }

    public function findId($id, array $relational = [],$orderBy='ASC', $coloms= 'id')
    {
        return ($relational) ? $this->model->with($relational)->orderBy($coloms,$orderBy)->find($id)
        : $this->model->orderBy($coloms,$orderBy)->find($id);
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
