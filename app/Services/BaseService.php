<?php

namespace App\Services;

class BaseService
{
    protected $model;

    public function all()
    {
        $objects = $this->model->all();
        if ($objects){
            return $objects;
        }
        return false;
    }

    public function getSelect($field)
    {
        $object = $this->model->select($field);
        if ($object){
            return $object;
        }
        return false;
    }

    public function getSelectWithRelation($field, $relation)
    {
        $object = $this->model->with($relation)->select($field);
        return $object;
    }

    public function getById($id)
    {
        $object = $this->model->find($id);
        if ($object) {
            return $object;
        }
        return error_notFound($id);
    }

    public function delete($id)
    {
        $result = $this->model->find($id);
        if ($result instanceof $this->model) {
            $result->delete();
            return $result;
        }
        return false;
    }

}
