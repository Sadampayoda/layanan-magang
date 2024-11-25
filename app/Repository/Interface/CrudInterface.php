<?php

namespace App\Repository\Interface;

interface CrudInterface{
    public function setModel(string $model);
    public function all();
    public function find(array $find);
    public function findId($id);
    public function create($data);
    public function update($data,$id);
    public function delete($id);
}

