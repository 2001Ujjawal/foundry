<?php

namespace App\Controllers\Vendors;

use App\Controllers\Common;
use App\Services\Vendors\ApiService;
//use App\Models\AdminModel;
use App\Models\CommonModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ApiController extends Common
{
    protected $commonModel;
    protected $apiService;
    public function __construct()
    {
        $this->session = session();
        $this->apiService = new ApiService();
        $this->commonModel = new CommonModel();;
    }

    /** Login */
    public function login()
    {
        $loginDetails = $this->request->getJSON(true);
        $resp = $this->apiService->login($loginDetails);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $data['user_id'] = $resp[3]['data']['uid'];
            $data['user_name'] = $resp[3]['data']['name'];
            $data['user_image'] = $resp[3]['data']['image'];
            $data['user_type'] = USER_TYPE_VENDORS;
            list($auth_token, $auth_cookie) = generateJwtTokenVendor($data);
            $this
                ->response
                ->setStatusCode(200)
                ->setCookie($auth_cookie);

            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }


    /** Product Section */
    public function createdProduct()
    {
        $payload = $this->validateJwtApiTokenVendor();
        $productDetails = $this->request->getPost();
        $files = $this->request->getFiles('images');
        $productDetails['user_id']   = $payload->user_id;
        $productDetails['user_type'] = $payload->user_type;
        $resp = $this->apiService->createdProduct($productDetails, $files);

        if (!$resp[0]) {
            return $this->apiError($resp[1], $resp[2], $resp[3]);
        }

        return $this->apiSuccess($resp[1], $resp[2], $resp[2]);
    }

    public function updateProduct()
    {
        $payload = $this->validateJwtApiTokenVendor();

        $productDetails = $this->request->getPost();
        $imageFile = $this->request->getFile('image');
        $productDetails['user_id'] = $payload->user_id;
        $productDetails['user_type'] = $payload->user_type;

        $resp = $this->apiService->updateProduct($productDetails, $imageFile);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }
    public function deleteProduct()
    {
        $payload = $this->validateJwtApiTokenVendor();

        $productDetails = $this->request->getPost();
        $productDetails['user_id'] = $payload->user_id;
        $productDetails['user_type'] = $payload->user_type;

        $resp = $this->apiService->deleteProduct($productDetails);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }
    public function updateProductStatus()
    {
        $payload = $this->validateJwtApiTokenVendor();

        $productDetails = $this->request->getJSON(true);
        $productDetails['user_id'] = $payload->user_id;
        $productDetails['user_type'] = $payload->user_type;
        $resp = $this->apiService->updateProductStatus($productDetails);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }
    /** Product Section */

    /** Change Password */
    public function changePassword()
    {
        $payload = $this->validateJwtApiTokenVendor();

        $vendorDetails = $this->request->getPost();
        $vendorDetails['user_id'] = $payload->user_id;
        $vendorDetails['user_type'] = $payload->user_type;

        $resp = $this->apiService->updatePassword($vendorDetails);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }
    /** Change Password */

    /** Forgot Password */
    public function forgotPassword()
    {
        $vendorDetails = $this->request->getJSON(true);
        $resp = $this->apiService->forgotPassword($vendorDetails);

        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }
    public function resetPassword()
    {
        $vendorDetails = $this->request->getJSON(true);
        $resp = $this->apiService->resetPassword($vendorDetails);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }
    /** Change Password */

    /** Update Profile */
    public function edit_profile()
    {
        $payload = $this->validateJwtApiTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }
        $vendorDetails = $this->request->getPost();
        $imageFile = $this->request->getFile('image');
        $vendorDetails['user_id'] = $payload->user_id;
        $resp = $this->apiService->updateProfile($vendorDetails, $imageFile);

        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $profile = $this->commonModel->getSingleData(VENDOR_TABLE, ['uid' => $payload->user_id, 'status !=' => DELETED_STATUS]);
            $data['user_id'] = $profile['uid'];
            $data['user_name'] = $profile['name'];
            $data['user_image'] = $profile['image'];
            $data['user_type'] = USER_TYPE_VENDORS;
            list($auth_token, $auth_cookie) = generateJwtTokenVendor($data);
            $this
                ->response
                ->setStatusCode(200)
                ->setCookie($auth_cookie);
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }
    /** Update Profile Data */


    public function getSubCategories()
    {
        // $payload = $this->validateJwtApiTokenVendor();
        // if (!$payload) {
        //     return redirect()->to(base_url('vendor/login'));
        // }

        $categoryId = $this->request->getGet('categoryId');

        $resp = $this->apiService->getSubCategories($categoryId);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }


    public function deleteProductImage()
    {
        $payload = $this->validateJwtApiTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }

        $imageDetails = $this->request->getJSON(true);
        $imageDetails['user_id'] = $payload->user_id;
        $resp = $this->apiService->deleteProductImage($imageDetails);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }


    public function editProduct()
    {
        $payload = $this->validateJwtApiTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }
        $productDetails = $this->request->getPost();
        $files = $this->request->getFiles('images');
        $productDetails['user_id'] = $payload->user_id;
        $resp = $this->apiService->editProduct($productDetails, $files);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }
}
