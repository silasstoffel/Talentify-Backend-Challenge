<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->get('/', fn() => redirect('/api-docs/index.html'));

// Create recruiter
$router->post('recruiters', 'RecruiterController@store');

$router->post('auth', 'LoginController@store');

$router->get('/jobs', 'OpportunitiesFilterController@index');

// Endpoints protected
$v1 = ['prefix' => '/v1', 'middleware' => 'auth'];

$router->group($v1, function () use ($router) {
    // Opportunities
    $router->group(['prefix' => '/opportunities'], function () use ($router) {
        $router->get('/', 'OpportunityController@index');
        $router->get('/{id}', 'OpportunityController@get');
        $router->post('/', 'OpportunityController@store');
        $router->put('/{id}', 'OpportunityController@update');
        $router->delete('/{id}', 'OpportunityController@delete');
    });
});
