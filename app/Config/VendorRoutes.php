<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

/** Vendor */
$routes->group('vendor', ['namespace' => 'App\Controllers\Vendors'], function ($routes) {
    $routes->get('', function () {
        return redirect()->to('/vendor/login');
    });
    $routes->get('', 'WebController::index');
    $routes->get('login', 'WebController::index');
    $routes->get('dashboard', 'WebController::dashboard');
    $routes->get('products', 'WebController::products');
    $routes->get('add-product', 'WebController::add_product');
    $routes->get('change-password', 'WebController::changePassword');
    $routes->get('profile', 'WebController::profile');
    $routes->get('edit-profile', 'WebController::edit_profile');
    $routes->get('view-product/(:any)', 'WebController::view_product/$1');
    $routes->get('requests', 'WebController::requests');
    $routes->get('ratings', 'WebController::ratings');
    $routes->get('logout', 'WebController::logout');

    // Bulk Upload 
    $routes->get('bulk-upload', 'WebController::bulkUploadForm');
    $routes->post('bulk-upload-submit', 'WebController::bulkUploadSubmit');

});

$routes->group('vendor/api', ['namespace' => 'App\Controllers\Vendors'], function ($routes) {
    $routes->post('login', 'ApiController::login');
    $routes->post('change-password', 'ApiController::changePassword');
    $routes->post('forgot-password', 'ApiController::forgotPassword');
    $routes->post('reset-password', 'ApiController::resetPassword');
    $routes->post('edit-profile', 'ApiController::edit_profile');
    $routes->get('get-subcategories', 'ApiController::getSubCategories');
    /** Product */
    $routes->group("product", function ($routes) {
        $routes->post('created', 'ApiController::createdProduct');
        $routes->post('update', 'ApiController::updateProduct');
        $routes->post('update-status', 'ApiController::updateProductStatus');
        $routes->post('delete', 'ApiController::deleteProduct');
        $routes->post('image-delete', 'ApiController::deleteProductImage');
        $routes->post('edit-product', 'ApiController::editProduct');
    });
    /** Product */
});
/**Leads */
$routes->group('vendor', ['namespace' => 'App\Controllers\Vendors'], function($routes) {
    $routes->post('payment/create-order', 'PaymentController::createOrder');
    $routes->post('payment/verify', 'PaymentController::verifyPayment');
});



/**Leads */
/** Vendor */
