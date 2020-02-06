<?php

function success($data, $code = 200)
{
    $message = 'Successfully, Data is received';
    return response()->json([
        'code' => $code,
        'message' => $message,
        'data' => $data
    ]);
}

function success_create($data, $code = 201)
{
    return response()->json([
        'code' => $code,
        'message' => 'Successfully, record created',
        'data' => $data
    ]);
}

function success_update($data, $code = 202)
{
    return response()->json([
        'code' => $code,
        'message' => 'Successfully, record updated',
        'data' => $data
    ]);
}

function success_delete($data, $code = 202)
{
    return response()->json([
        'code' => $code,
        'message' => 'Successfully, record deleted',
        'data' => $data
    ]);
}

function error($message = 'Missing fill', $code = 400)
{
    return response()->json([
        'code' => $code,
        'message' => $message,
    ]);
}

function error_validate($validate, $code = 403)
{
    return response()->json([
        'code' => $code,
        'message' => 'Missing fill',
        'validate' => $validate
    ]);
}

function error_notFound($code = 404)
{
    return response()->json([
        'code' => $code,
        'message' => 'Error, Record not found',
    ]);
}

function countUser()
{
    $totalUsers = count(\App\User::all());
    return $totalUsers;
}

function roleAdmin()
{
    $roleAdmin = \Spatie\Permission\Models\Role::where('name', 'administration')->first();
    return $roleAdmin;
}
