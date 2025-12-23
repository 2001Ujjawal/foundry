<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

/** Customer */
$routes->group('', ['namespace' => 'App\Controllers\Customer'], function ($routes) {
    $routes->get('/', 'WebController::index');
    $routes->get('product-list', 'WebController::product_list'); // 
    $routes->get('category', 'WebController::category_product');
    $routes->get('product/(:any)', 'WebController::product_details/$1');
    $routes->get('registration', 'WebController::registration');
    $routes->get('logout', 'WebController::logout');
    $routes->get('vendor-register', 'WebController::vendor_register');
    $routes->get('product-search', 'ApiController::product_search_in_product_list');
});

$routes->group('customer/api', ['namespace' => 'App\Controllers\Customer'], function ($routes) {
    $routes->post('login', 'ApiController::login');
    $routes->post('ragister', 'ApiController::ragister');
    $routes->get('product-search', 'ApiController::product_search');
    $routes->post('forget-password-email-check', 'ApiController::forget_password_email_otp_send');
    $routes->group("request", function ($routes) {
        $routes->post('created', 'ApiController::createdRequest');
    });

    $routes->group("rating", function ($routes) {
        $routes->post('created', 'ApiController::createdRating');
    });
});
/** Customer */
