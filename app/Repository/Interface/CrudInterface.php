<?php

namespace App\Repository\Interface;

interface CrudInterface{
    public function setModel(string $model);
    public function all(array $relational = []);
    public function find(array $find, array $relational = []);
    public function findId($id, array $relational = []);
    public function create($data);
    public function update($data,$id);
    public function delete($id);
}

