<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

trait ResponseTrait
{

    public function success($data, $options = null)
    {
        return Response::success($data, $options);
    }

    public function created($data, $options = null)
    {
        return Response::created($data, $options);
    }

    public function deleted()
    {
        return Response::deleted();
    }

    public function ok()
    {
        return Response::ok();
    }

    public function error($message = "Something went wrong!", $statusCode = ResponseCode::HTTP_INTERNAL_SERVER_ERROR)
    {
        return Response::error($message, $statusCode);
    }

    public function badRequest($message = 'Bad Request')
    {
        return Response::badRequest($message);
    }

    public function unprocessable($message = 'Unprocessable Entity Request')
    {
        return Response::unprocessable($message);
    }

    public function notFound($message = 'not_found')
    {
        return Response::notFound($message);
    }
}
