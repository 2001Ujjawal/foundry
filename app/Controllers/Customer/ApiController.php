<?php

namespace App\Controllers\Customer;

use App\Controllers\Common;
use App\Services\Customer\ApiService;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ApiController extends Common
{
    protected $apiService;
    public function __construct()
    {
        $this->session = session();
        $this->apiService = new ApiService();
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
            $data['user_email'] = $resp[3]['data']['email'];
            $data['user_mobile'] = $resp[3]['data']['mobile'];
            $data['user_image'] = $resp[3]['data']['image'];
            $data['user_type'] = USER_TYPE_CUSTOMER;
            list($auth_token, $auth_cookie) = generateJwtTokenCustomer($data);
            $this
                ->response
                ->setStatusCode(200)
                ->setCookie($auth_cookie);

            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }

    /** ragister */
    public function ragister()
    {
        $customerDetails = $this->request->getPost();
        $imageFile = $this->request->getFile('image');

        $resp = $this->apiService->createdCustomer($customerDetails, $imageFile);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }

    /** Request */
    public function createdRequest()
    {
        $payload = $this->validateJwtApiTokenCustomer();

        $details = $this->request->getJSON(true);
        $details['user_id'] = $payload->user_id;
        $resp = $this->apiService->createdRequest($details);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }
    /** Request */

    public function createdRating()
    {
        $payload = $this->validateJwtApiTokenCustomer();
        $details = $this->request->getJSON(true);
        $details['user_id'] = $payload->user_id;
        $resp = $this->apiService->createdRating($details);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }



    public function product_search()
    {
        $search = $this->request->getGet('search');
        $resp = $this->apiService->productSearch($search);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }


    public function product_search_in_product_list()
    {
        $search = $this->request->getGet('product_search');
        $resp = $this->apiService->productSearchInProductList($search);
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }


    public function forget_password_email_otp_send()
    {
        
        $loginDetails = $this->request->getJSON(true);
        $resp = $this->apiService->forget_password_email_otp_send($loginDetails);
         
        if (!$resp[0]) {
            $this->apiError($resp[1], $resp[2], $resp[3]);
        } else {
            $this->apiSuccess($resp[1], $resp[2], $resp[3]);
        }
    }
}
