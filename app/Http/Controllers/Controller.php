<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function responseSuccess($data = [], $httpCode = 200)
    {
        return response()->json($data, $httpCode);
    }

    protected function response500($data = [], $httpCode = 500)
    {
        return response()->json($data, $httpCode);
    }

    protected function response400($data = [], $httpCode = 400)
    {
        return response()->json($data, $httpCode);
    }

    protected function responseUserError($message)
    {
        return $this->response400([
            'error' => true,
            'message' => $message,
        ]);
    }

    protected function responseAppError($message)
    {
        return $this->response500([
            'error' => true,
            'message' => $message,
        ]);
    }
}
