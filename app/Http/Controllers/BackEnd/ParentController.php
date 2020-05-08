<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        // 1. Check validation
        $this->validate($request, $this->model->rulesToCreate);
        $attributes = $request->all();
        if(isset($attributes->password)){
            $attributes->password = Hash::make($attributes->password);
        }
        // 2. Try to create the records
        $createdObject = $this->service->create($attributes);
        // 3. If everything is fine, response success to user
        if ($createdObject) {
            return $createdObject;
        }
        // 4. Say sorry as something went wrong.
        return error_notFound();
    }


    public function update(Request $request, $id)
    {
        if ($id) {
            $attributes = $request->all();
            // 1. Validate if the attributes are processable
            $this->validate($request, $this->model->rulesToUpdate);
            // 2. Try to update the records
            $updatedObject = $this->service->updateById($id, $attributes);
            // 3. If everything is fine, response success to user
            if ($updatedObject) {
                return $updatedObject;
            }
            // 4. Say sorry as something went wrong.
            return error('Record id is required');
        }
        return error("Record id is required");
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
//
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
