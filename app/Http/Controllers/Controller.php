<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function responseSuccess($data = null, int $httpCode = 200)
    {
        return response()->json($data, $httpCode);
    }

    protected function response500($data = null, int $httpCode = 500)
    {
        return response()->json($data, $httpCode);
    }

    protected function response400($data = null, int $httpCode = 400)
    {
        return response()->json($data, $httpCode);
    }

    protected function responseUserError($message, int $code = 400)
    {
        return $this->response400(['message' => $message], $code);
    }

    protected function responseAppError($message)
    {
        return $this->response500(['message' => $message]);
    }
}
