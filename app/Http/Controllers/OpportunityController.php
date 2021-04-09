<?php


namespace App\Http\Controllers;


class OpportunityController extends Controller
{

    public function index()
    {
        return $this->responseSuccess([], 200);
    }

    public function get()
    {
        return $this->responseSuccess([], 204);
    }

    public function store()
    {
        return $this->responseSuccess([], 201);
    }

    public function update()
    {
        return $this->responseSuccess([], 204);
    }


}
