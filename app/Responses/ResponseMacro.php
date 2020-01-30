<?php

/** USAGE:
 * return response()->success($data);
 * return response()->notFound();
 * return response()->created($createdResource);
 * return response()->error($errorMessage, $errorCode);
 */

use Symfony\Component\HttpFoundation\Response as ResponseCode;
use \Illuminate\Http\Response;

// Success
Response::macro('success', function ($data, $options = null) {
    // Handles boolean success responses.
    // WARNING: This might be an unexpected problem or
    // a wrongly asigned response.
    $booleanData = is_bool($data);
    if ($booleanData) {
        return response()->json(null, ResponseCode::HTTP_NO_CONTENT);
    }
    // Regular success response
    return response()->json(['data' => $data, 'options' => $options], ResponseCode::HTTP_OK);
});

// Record is created. We return the data back to the request caller
Response::macro('created', function ($data) {
    return response()->json($data, ResponseCode::HTTP_CREATED);
});


// Deleted and OK, No data return back.
$handleDeleteAndOkResponses = function () {
    return response()->json(null, ResponseCode::HTTP_NO_CONTENT);
};

Response::macro('deleted', $handleDeleteAndOkResponses);

Response::macro('ok', $handleDeleteAndOkResponses);

// Internal server error.
Response::macro('error', function ($message, $statusCode = ResponseCode::HTTP_INTERNAL_SERVER_ERROR) {
    return response()->json(
        ['error' => $message],
        $statusCode
    );
});

// The request is corrupted or invalid. This is normally cause by user, and server believe that this is user's fault.
Response::macro('badRequest', function ($message = 'Bad Request') {
    return response()->json(
        ['error' => $message],
        ResponseCode::HTTP_BAD_REQUEST
    );
});

// Request cannot be proceeded. Required fields might be missing, or the request cannot be made at this moment of time.
Response::macro('unprocessable', function ($message = 'Unprocessable Entity Request') {
    return response()->json(
        ['error' => $message],
        ResponseCode::HTTP_UNPROCESSABLE_ENTITY
    );
});

// Request url cannot be found
Response::macro('notFound', function ($message = 'not_found') {
    return response()->json(
        ['error' => $message],
        ResponseCode::HTTP_NOT_FOUND
    );
});
