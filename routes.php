<?php

$router->get('/', 'HomeController@index');
$router->get('/listings', 'ListingController@index');
$router->get('/listings/create', 'ListingController@create');
$router->get('/listings/{id}', 'ListingController@show');
$router->get('/listings/edit/{id}', 'ListingController@edit');

// create job router
$router->post('/listings', 'ListingController@store');
$router->put('/listings/{id}', 'ListingController@update');
// delete listing
$router->delete('/listings/{id}', 'ListingController@destroy');

