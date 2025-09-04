<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//$routes->get('', 'Home::index');
/** Admin */
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('login', 'WebController::index');
    $routes->get('dashboard', 'WebController::dashboard');
    $routes->get('vendors', 'WebController::vendors');
    $routes->get('customers', 'WebController::customers');
    $routes->get('category', 'WebController::category');
    $routes->get('products', 'WebController::products');
    $routes->get('view-product', 'WebController::view_product');
    $routes->get('view-vendor-details', 'WebController::view_vendor_details');
    $routes->get('change-password', 'WebController::changePassword');
    $routes->get('requests', 'WebController::requests');
    $routes->get('ratings', 'WebController::ratings');
    $routes->get('header-content', 'WebController::headerContent');
    $routes->get('logout', 'WebController::logout');
    $routes->get('view-product/(:any)', 'WebController::view_product/$1');
    $routes->get('meta-content', 'WebController::metaContent');
    $routes->get('categories', 'WebController::getCategories');
    $routes->post('send-email', 'WebController::send_email');
});

$routes->group('admin/api', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->post('login', 'ApiController::login');
    $routes->post('change-password', 'ApiController::changePassword');
    $routes->get('get-excel-sheet-data', 'ApiController::getExcelData');

    /** Customer */
    $routes->group("customer", function ($routes) {
        $routes->post('created', 'ApiController::createdCustomer');
        $routes->post('update', 'ApiController::updateCustomer');
        $routes->post('update-status', 'ApiController::updateCustomerStatus');
        $routes->post('delete', 'ApiController::deleteCustomer');
    });
    /** Customer */

    /** Vendor */
    $routes->post('created-vendor', 'ApiController::createdVendor');
    $routes->post('update-vendor', 'ApiController::updateVendor');
    $routes->post('vendor-update-status', 'ApiController::updateVendorStatus');
    $routes->post('delete-vendor', 'ApiController::deleteVendor');
    $routes->post('vendor-verify', 'ApiController::verifyVendor');

    /** Vendor */

    /** Category */
    $routes->group("category", function ($routes) {
        $routes->post('created', 'ApiController::createdCategory');
        $routes->post('update', 'ApiController::updateCategory');
        $routes->post('update-status', 'ApiController::updateCategoryStatus');
        $routes->post('delete', 'ApiController::deleteCategory');
    });
    /** Category */

    /** Product */
    $routes->group("product", function ($routes) {
        $routes->post('update-status', 'ApiController::updateProductStatus');
        $routes->post('delete', 'ApiController::deleteProduct');
        $routes->post('verify', 'ApiController::verifyProduct');
        $routes->post('approval', 'ApiController::approvalProduct');
        $routes->post('ordering', 'ApiController::productOrdering');
    });
    $routes->group("rating", function ($routes) {
        $routes->post('delete', 'ApiController::deleteRating');
    });

    $routes->group("request", function ($routes) {
        $routes->post('delete', 'ApiController::deleteRequest');
    });

    $routes->group("seo", function ($routes) {
        $routes->post('add-update', 'ApiController::addEndUpdateSeoTags');
    });


    /** Product */
});
/** Admin */

if (file_exists(APPPATH . 'Config/VendorRoutes.php')) {
    require APPPATH . 'Config/VendorRoutes.php';
}

if (file_exists(APPPATH . 'Config/CustomerRoutes.php')) {
    require APPPATH . 'Config/CustomerRoutes.php';
}
