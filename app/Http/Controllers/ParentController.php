<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    use ResponseTrait;

    protected $service;
    protected $model;

    public function all()
    {
        return $this->success($this->service->getList());
    }

    public function store(Request $request)
    {
        $attributes = $request->all();
        // 2. Try to create the records
        $createdObject = $this->service->create($attributes);
        // 3. If everything is fine, response success to user
        if ($createdObject) {
            return $this->success($createdObject);
        }
        // 4. Say sorry as something went wrong.
        return $this->error();
    }


    public function update(Request $request, $id)
    {
        return 'hello update';
    }

    public function delete($id)
    {
        // 1. Check if id is valid
        if ($id) {
            // 2. Try to delete the records
            $deleteOk = $this->service->delete($id);
            // 3. If everything is fine, response success to user
            if ($deleteOk) {
                return success_delete($deleteOk);
            }
            // 4. Say sorry as something went wrong.
            return error_notFound($id);
        }
        return $this->unprocessable("Record id is required");
    }

//    public function getById($id)
//    {
//        $object = $this->service->getById($id);
//        if ($object) {
//            return $this->success($object);
//        }
//        return $this->badRequest("Given ID is not exist.");
//    }
//
//    public function create(Request $request)
//    {
//        $attributes = $request->all();
//        // 1. Validate if the attributes are processable
//        $validator = Validator::make($attributes, $this->model->rulesToCreate);
//        if ($validator->fails()) {
//            return $this->unprocessable($validator->messages());
//        }
//        // 2. Try to create the records
//        $createdObject = $this->service->create($attributes);
//        // 3. If everything is fine, response success to user
//        if ($createdObject) {
//            return $this->success($createdObject);
//        }
//        // 4. Say sorry as something went wrong.
//        return $this->error();
//    }
//
//    public function update(Request $request, $id)
//    {
//        if ($id) {
//            $attributes = $request->all();
//            // 1. Validate if the attributes are processable
//            $validator = Validator::make($attributes, $this->model->rulesToUpdate);
//            if ($validator->fails()) {
//                return $validator->errors();
//            }
//            // 2. Try to update the records
//            $updatedObject = $this->service->updateById($id, $attributes);
//            // 3. If everything is fine, response success to user
//            if ($updatedObject) {
//                return $this->success($updatedObject);
//            }
//            // 4. Say sorry as something went wrong.
//            return $this->error();
//        }
//        return $this->unprocessable("Record id is required");
//    }
//
//    public function delete($id)
//    {
//        // 1. Check if id is valid
//        if ($id) {
//            // 2. Try to delete the records
//            $deleteOk = $this->service->delete($id);
//            // 3. If everything is fine, response success to user
//            if ($deleteOk) {
//                return $this->success($deleteOk);
//            }
//            // 4. Say sorry as something went wrong.
//            return $this->error();
//        }
//        return $this->unprocessable("Record id is required");
//    }
//
//    public function schema()
//    {
//        return $this->success($this->service->getSchema());
//    }
}
