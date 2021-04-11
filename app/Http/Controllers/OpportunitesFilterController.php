<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class OpportunitesFilterController extends Controller
{

    public function index(Request $request)
    {
        // query string: keyword, address, salary, company
        return $this->responseSuccess([
            $request->keyword
        ], 200);
    }

}
