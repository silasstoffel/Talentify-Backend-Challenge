<?php


final class ApiCommonRequestHelpers
{

    public function createRecruiterAccount($instance, array $data)
    {
        $response = $instance->json('POST', '/recruiters', $data);
        return $response;
    }

}
