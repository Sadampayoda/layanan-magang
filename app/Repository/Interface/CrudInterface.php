<?php

namespace App\Repository\Interface;

interface CrudInterface{
    public function setModel(string $model);
    public function all(array $relational = [],$orderBy = 'ASC', $coloms= 'id');
    public function find($key, $value, array $relational = [], $orderBy = 'ASC', $coloms= 'id');
    public function findId($id, array $relational = [], $orderBy = 'ASC', $coloms= 'id');
    public function create($data);
    public function update($data,$id);
    public function delete($id);
}

