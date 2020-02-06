<?php

namespace App\Services;

class BaseService
{
    protected $model;

    public function all()
    {
        $objects = $this->model->all();
        if ($objects) {
            return $objects;
        }
        return false;
    }

    public function getSelect($field)
    {
        $object = $this->model->select($field);
        if ($object) {
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

    public function create($attributes)
    {
        if (!$attributes) {
            return false;
        }
        return $this->model->create($attributes);
    }

    public function updateOrCreate($attributes)
    {
        if (!$attributes) {
            return false;
        }
        return $this->model->updateOrCreate($attributes);
    }

    public function updateById($id, $attribute)
    {
        $modelObj = $this->getById($id);
        if (!$modelObj) {
            return false;
        }
        $result = $modelObj->fill($attribute);
        $result->update();
        return $result;
    }

    public function getByArray($field, $attribute)
    {
        $result = $this->model->whereIn($field, $attribute)->get();
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function getList()
    {
        return $this->model->all()->toArray();
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

    public function getData()
    {

    }

    public function assignRole()
    {

    }

    public function givePermission()
    {

    }
}
