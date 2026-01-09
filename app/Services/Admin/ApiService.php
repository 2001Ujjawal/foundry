<?php

namespace App\Services\Admin;

use CodeIgniter\Validation\Validation;

use App\Models\CommonModel;
use App\Models\Admin\ApiModel;

class ApiService
{
    protected $validation;
    protected $apiModel;
    protected $commonModel;
    protected $db;


    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->apiModel = new ApiModel();
        $this->commonModel = new CommonModel();
        $this->db =   \Config\Database::connect();
    }

    /** Login */
    public function login($data)
    {
        $validationRules = [
            'email'      => 'required',
            'password'   => 'required',
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }

        try {
            $success = $this->apiModel->checkAdminLogin($data['email']);
            if (!$success) {
                return [false, 401, 'Invalid email', ['invalid_credentials']];
            }

            $plainPassword = $data['password'];
            $hashedPassword = $success['password'];
            if (!password_verify($plainPassword, $hashedPassword)) {
                return [false, 401, 'Invalid Password', ['invalid_credentials']];
            }

            return [true, 200, "Login successfully", ["data" => $success ]];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    /** Login */

    /** Customer Section */
    public function createdCustomer($data, $file)
    {
        $validationRules = [
            'name'      => 'required',
            'email'     => 'required',
            'mobile'    => 'required',
            'dob'       => 'required',
            'password'  => 'required',
            'company' => 'required',
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $vendorUid = generateUid();
        // Handle file upload
        $uploadResult = null;
        $timestamp = timestamp();
        $image_path = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadResult = uploadFile($file, 'vendor', $timestamp);
            if (!isset($uploadResult['error'])) {
                $image_path = $uploadResult['path'];
            } else {
                $image_path = null;
            }
        }


        try {
            $plainPassword = $data['password'];
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

            $addData = [
                'uid'        => $vendorUid,
                'image'      => $image_path,
                'name'       => $data['name'],
                'mobile'     => $data['mobile'],
                'email'      => $data['email'],
                'password'   => $hashedPassword,
                'dob'        => $data['dob'] ?? "",
                'company'    => $data['company'] ?? NULL,
                'created_by' => $data['user_id'] ?? NULL,
            ];
            $success = $this->commonModel->insertData(CUSTOMER_TABLE, $addData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Customer registration failed.',
                    ['error' => 'Database insert failed']
                ];
            }

            $this->sendCustomerPasswordToEmail($data['name'], $data['email'], $plainPassword);

            return [
                true,
                200,
                'Customer registered successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    public function updateCustomer($data, $file)
    {
        $validationRules = [
            'name'      => 'required',
            'email'     => 'required',
            'mobile'    => 'required',
            'dob'       => 'required'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $customerUid = $data['customerUid'];
        $timestamp = timestamp();
        // Handle file upload
        $uploadResult = null;
        $image_path = '';
        if ($file && $file->isValid() && !$file->hasMoved()) {

            $uploadResult = uploadFile($file, 'customer', $timestamp);
            if (isset($uploadResult['error'])) {
                return [
                    'status'     => 'failed',
                    'statusCode' => 400,
                    'message'    => 'File upload failed',
                    'errors'     => ['customer Image' => $uploadResult['error']],
                ];
            }
            $image_path = $uploadResult['path'];
        }

        try {
            $updateData = [
                'name'       => $data['name'],
                'mobile'     => $data['mobile'],
                'email'      => $data['email'],
                'dob'        => $data['dob'],
                'updated_by' => $data['user_id'] ?? NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            if (!empty($image_path)) {
                $updateData['image'] = $image_path;
            }

            $success = $this->commonModel->UpdateData(CUSTOMER_TABLE, ['uid' => $customerUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Customer Details Update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'Customer details update successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    public function updateCustomerStatus($data)
    {
        $validationRules = [
            'status'     => 'required',
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $customerUid = $data['uid'];

        try {
            $updateData = [
                'status'      => $data['status'],
                'updated_by' => $data['user_id'] ?? NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData(CUSTOMER_TABLE, ['uid' => $customerUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Customer Details Update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'Customer details update successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    public function deleteCustomer($data)
    {
        $validationRules = [
            'uid'      => 'required'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $customerUid = $data['uid'];

        try {
            $updateData = [
                'status'     => DELETED_STATUS,
                'updated_by' => $data['user_id'] ?? NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData(CUSTOMER_TABLE, ['uid' => $customerUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Customer Details Deleted failed.',
                    ['error' => 'Database Deleted failed']
                ];
            }

            return [
                true,
                200,
                'Customer details Deleted successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    /** Customer Section */

    /** Vendor Section */
    public function createdVendor($data, $file)
    {
        // echo '<pre>';
        // print_r($data);
        // exit;
        $validationRules = [
            'company'       => 'required',
            'name'          => 'required',
            'email'         => 'required',
            'mobile'        => 'required',
            'country'       => 'required',
            // 'dob'      => 'required'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $vendorUid = generateUid();
        $timestamp = timestamp();
        // Handle file upload
        $uploadResult = null;
        $image_path = '';
        if ($file && $file->isValid() && !$file->hasMoved()) {

            $uploadResult = uploadFile($file, 'vendor', $timestamp);
            if (isset($uploadResult['error'])) {
                return [
                    'status'     => 'failed',
                    'statusCode' => 400,
                    'message'    => 'File upload failed',
                    'errors'     => ['Vendor Image' => $uploadResult['error']],
                ];
            }
            $image_path = $uploadResult['path'];
        }

        try {
            $plainPassword = generateRandomPassword(8);
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

            $addData = [
                'uid'         => $vendorUid,
                'company'     => $data['company'],
                'country'     => $data['country'],
                'image'       => $image_path,
                'name'        => $data['name'],
                'mobile'      => $data['mobile'],
                'email'       => $data['email'],
                // 'password'    => $hashedPassword,
                'dob'         => $data['dob'] ?? "",
                'created_by'  => $data['user_id'] ?? NULL,
                'website'     => $data['website'] ?? null,
                'address'     => $data['address'] ?? null,
                'city'        => $data['city'] ?? null,
                'states'      => $data['states'] ?? null,
                'gst'         => $data['gst'] ?? null,
                'created_by'  => "",
                'status'      => 'inactive'
            ];

            $success = $this->apiModel->createdVendor($addData);

            if (!$success) {
                return [
                    false,
                    500,
                    'Vendor registration failed.',
                    ['error' => 'Database insert failed']
                ];
            }
            $subject = VENDOR_REGISTER_EMAIL_SUBJECT_FOR_SELLER;

            $message = "
                        <p>🎉 Thank you for registering with <strong>FoundryBiz</strong> as a Seller!</p>
                        <p>We’re reviewing your account, and once it’s activated, your login credentials will be shared with you via email.</p>
                        <p>Thank You,<br>FoundryBiz Team</p>
                     ";

            $this->sendVendorPasswordToEmail($data['email'], $subject, $message);


            return [
                true,
                200,
                'Vendor registered successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    public function updateVendor($data, $file)
    {
        $validationRules = [
            'name'      => 'required',
            'email'     => 'required',
            'mobile'    => 'required',
            'country'   => 'required',

        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $vendorUid = $data['vendorUid'];
        // Handle file upload
        $uploadResult = null;
        $timestamp = timestamp();
        $image_path = '';
        if ($file && $file->isValid() && !$file->hasMoved()) {

            $uploadResult = uploadFile($file, 'vendor', $timestamp);
            if (isset($uploadResult['error'])) {
                return [
                    'status'     => 'failed',
                    'statusCode' => 400,
                    'message'    => 'File upload failed',
                    'errors'     => ['Vendor Image' => $uploadResult['error']],
                ];
            }
            $image_path = $uploadResult['path'];
        }

        try {
            $updateData = [
                'company'    => $data['company'],
                'country'    => $data['country'],
                'name'       => $data['name'],
                'mobile'     => $data['mobile'],
                'email'      => $data['email'],
                'dob'        => $data['dob'] ?? null,
                'updated_by' => $data['user_id'] ?? NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (!empty($image_path)) {
                $updateData['image'] = $image_path;
            }

            $success = $this->commonModel->UpdateData(VENDOR_TABLE, ['uid' => $vendorUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Vendor Details Update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'Vendor details update successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    public function updateVendorStatus($data)
    {
        $validationRules = [
            'status'      => 'required'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $vendorUid = $data['uid'];

        try {
            $updateData = [
                'status'     => $data['status'],
                'updated_by' => $data['user_id'] ?? NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];


            $this->sendPasswordAfterVendor($vendorUid);

            $success = $this->commonModel->UpdateData(VENDOR_TABLE, ['uid' => $vendorUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Vendor Details Update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'Vendor details update successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }

    public function sendPasswordAfterVendor($vendorUid)
    {
        $db = \Config\Database::connect();

        $getVendor = $db->table('vendor')
            ->select('name , email , password_send_status')
            ->where('uid', $vendorUid)
            ->get()
            ->getRow();

        if (!$getVendor) {
            return false;
        }

        $email = $getVendor->email ?? "";
        $name = $getVendor->name ?? "N/A";
        $isVerify = $getVendor->password_send_status ?? 0;


        if ((int)$isVerify === 0) {
            $plainPassword = generateRandomPassword(8);
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

            $updatedPayload = [
                'password_send_status' => 1,
                'password' => $hashedPassword,
            ];
            $base_url = base_url('vendor/login');
            try {
                $db->table('vendor')
                    ->set($updatedPayload)
                    ->where('uid', $vendorUid)
                    ->update();

                $subject = "Your account is active – please log in";
                $message = "
                Dear $name,<br><br>
                Your account has been successfully created and activated.<br><br>
                <b>Login Email:</b> $email<br>
                <b>Password:</b> $plainPassword<br><br>
                You can log in here: <a href= '{$base_url}'>Login Page</a><br><br>
                Thank you for registering with FoundryBiz.<br><br>
                Regards,<br>
                Team FoundryBiz
            ";

                $this->sendVendorPasswordToEmail($email, $subject, $message);
                return true;
            } catch (\Throwable $th) {
                log_message('error', 'Password send error: ' . $th->getMessage());
                return false;
            }
        }

        return true; // already verified, do nothing
    }



    public function deleteVendor($data)
    {
        $validationRules = [
            'uid'      => 'required'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $vendorUid = $data['uid'];

        try {
            $updateData = [
                'status'     => DELETED_STATUS,
                'updated_by' => $data['user_id'] ?? NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData(VENDOR_TABLE, ['uid' => $vendorUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Vendor Details Deleted failed.',
                    ['error' => 'Database Deleted failed']
                ];
            }

            return [
                true,
                200,
                'Vendor details Deleted successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    /** Vendor Section */

    /** Category Section */
    public function createdCategory($data, $file)
    {
        $validationRules = [
            'name'       => 'required'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $categoryUid = generateUid();
        $timestamp = timestamp();

        // Handle file upload
        $uploadResult = null;
        $image_path = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {

            $uploadResult = uploadFile($file, 'category', $timestamp);
            if (isset($uploadResult['error'])) {
                return [
                    'status'     => 'failed',
                    'statusCode' => 400,
                    'message'    => 'File upload failed',
                    'errors'     => ['Vendor Image' => $uploadResult['error']],
                ];
            }
            $image_path = $uploadResult['path'];
        }

        try {
            $addData = [
                'uid'        => $categoryUid,
                'title'      => $data['name'],
                'image'      => $image_path,
                'path'       => $data['category'],
                'created_by' => $data['user_id'] ?? NULL,
            ];
            $success = $this->commonModel->insertData(CATEGORY_TABLE, $addData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Category Insert failed.',
                    ['error' => 'Database insert failed']
                ];
            }

            return [
                true,
                200,
                'Category Insert successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    public function updateCategory($data, $file)
    {
        $validationRules = [
            'name' => 'required'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }

        $categoryUid = $data['categoryUid'];
        $timestamp   = timestamp();

        $uploadResult = null;
        $image_path = '';
        if ($file && $file->isValid() && !$file->hasMoved()) {

            $uploadResult = uploadFile($file, 'category', $timestamp);
            if (isset($uploadResult['error'])) {
                return [
                    'status'     => 'failed',
                    'statusCode' => 400,
                    'message'    => 'File upload failed',
                    'errors'     => ['customer Image' => $uploadResult['error']],
                ];
            }
            $image_path = $uploadResult['path'];
        }

        try {
            $updateData = [
                'title'      => $data['name'],
                'path'       => $data['path'],
                'updated_by' => $data['user_id'] ?? NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (!empty($image_path)) {
                $updateData['image'] = $image_path;
            }

            $success = $this->commonModel->UpdateData(
                CATEGORY_TABLE,
                ['uid' => $categoryUid],
                $updateData
            );

            if (!$success) {
                return [
                    false,
                    500,
                    'Category Details Update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            if (!empty($data['path'])) {
                $this->commonModel->UpdateData(
                    PRODUCT_TABLE,
                    ['category_id' => $categoryUid],
                    ['subcategory_id' => $data['path']]
                );
            } else {
                $this->commonModel->UpdateData(
                    PRODUCT_TABLE,
                    ['category_id' => $categoryUid],
                    ['subcategory_id' => NULL]
                );
            }

            return [
                true,
                200,
                'Category details update successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }

    public function deleteCategory($data)
    {
        $validationRules = [
            'uid'      => 'required'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $categoryUid = $data['uid'];



        try {

            // $category = $this->db->table(CATEGORY_TABLE)->where('uid',  $categoryUid)->get()->getRow();
            // if (!$category) {
            //     return [false, 200, 'Category not found.', ['error' => 'Invalid UID']];
            // }

            // if (!empty($category->path)) {
            //     return [false, 200, "You can't delete this category because it has a sub-category.", []];
            // }
            $updateData = [
                'status'     => DELETED_STATUS,
                'updated_by' => $data['user_id'] ?? NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData(CATEGORY_TABLE, ['uid' => $categoryUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Category Details Deleted failed.',
                    ['error' => 'Database Deleted failed']
                ];
            }

            return [
                true,
                200,
                'Category details Deleted successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }

    public function updateCategoryStatus($data)
    {
        $validationRules = [
            'status'     => 'required',
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $categoryUid = $data['uid'];

        try {
            $updateData = [
                'status'      => $data['status'],
                'updated_by' => $data['user_id'] ?? NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData(CATEGORY_TABLE, ['uid' => $categoryUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Category Details Update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'Category details update successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    /** Category Section */

    /** Product Section */
    public function updateProductStatus($data)
    {
        $validationRules = [
            'status'     => 'required',
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $productUid = $data['uid'];

        try {
            $updateData = [
                'status'      => $data['status'],
                'updated_by' => $data['user_id'] ?? NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData(PRODUCT_TABLE, ['uid' => $productUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'pproduct Status Update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'pproduct Status update successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    public function deleteProduct($data)
    {
        $validationRules = [
            'uid'      => 'required'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $productUid = $data['uid'];

        try {
            $updateData = [
                'status'     => DELETED_STATUS,
                'updated_by' => $data['user_id'] ?? NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData(PRODUCT_TABLE, ['uid' => $productUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Product Details Deleted failed.',
                    ['error' => 'Database Deleted failed']
                ];
            }

            return [
                true,
                200,
                'Product details Deleted successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    /** Product Section */

    /** Update Password */
    public function updatePassword($data)
    {
        $validationRules = [
            'password'     => 'required',
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $adminUid = $data['user_id'];

        try {
            $plainPassword = $data['password'];
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
            $updateData = [
                'password'      => $hashedPassword,
                'updated_by'    => $data['user_id'] ?? NULL,
                'updated_at'    => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData(ADMIN_TABLE, ['uid' => $adminUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Password Update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'Password update successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    /** Update Password */

    private function sendVendorPasswordToEmail($email, $subject,  $message)
    {
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setFrom(EMAIL, EMAIL_APP_NAME);
        $emailService->setSubject($subject);
        $emailService->setMessage(
            $message
        );

        if (!$emailService->send()) {
            log_message('error', 'Failed to send password email to ' . $email);
        }
    }

    private function sendCustomerPasswordToEmail($name, $email, $plainPassword)
    {
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setFrom(EMAIL, EMAIL_APP_NAME);
        $emailService->setSubject('Your Account Password');
        $emailService->setMessage(
            "Dear $name,<br>" .
                "Your account has been created.<br>" .
                "Login Email: <b>$email</b><br>" .
                "Password: <b>$plainPassword</b><br>" .
                "You can log in here: <a href='http://localhost/foundry/customer/'>Login Page</a><br>" .
                "Thank you."
        );

        if (!$emailService->send()) {
            log_message('error', 'Failed to send password email to ' . $email);
        }
    }


    public function verifyProduct($data)
    {
        $validationRules = [
            'uid'     => 'required',
            'is_verify'     => 'required',

        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $productUid = $data['uid'];

        try {

            $updateData = [
                'is_verify'      => $data['is_verify'],
                'updated_by'    => $data['user_id'] ?? NULL,
                'updated_at'    => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData('product', ['uid' => $productUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Password Update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'product verify successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }


    public function deleteRating($data)
    {
        $validationRules = [
            'uid'      => 'required'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $productRatingUid = $data['uid'];

        try {
            $updateData = [
                'status'     => DELETED_STATUS,
                'update_at' => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData(PRODUCT_RATING_LIST_TABLE, ['uid' => $productRatingUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Product Details Deleted failed.',
                    ['error' => 'Database Deleted failed']
                ];
            }

            return [
                true,
                200,
                'Product details Deleted successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }

    public function deleteRequest($data)
    {
        $validationRules = [
            'uid'      => 'required'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $productRequestUid = $data['uid'];

        try {
            $updateData = [
                'status'     => DELETED_STATUS,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData('request', ['uid' => $productRequestUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Product request Deleted failed.',
                    ['error' => 'Database Deleted failed']
                ];
            }
            return [
                true,
                200,
                'Product request Deleted successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }

    public function approvalProduct($data)
    {
        $validationRules = [
            'uid'     => 'required',
            'is_admin_allow'     => 'required',

        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $productUid = $data['uid'];

        try {

            $updateData = [
                'is_admin_allow'      => $data['is_admin_allow'],
                'updated_by'    => $data['user_id'] ?? NULL,
                'updated_at'    => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData('product', ['uid' => $productUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Password Update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'product approve  successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }

    public function verifyVendor($data)
    {
        $validationRules = [
            'uid'     => 'required',
            'is_verify'     => 'required',

        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $productUid = $data['uid'];

        try {

            $updateData = [
                'is_verify'      => $data['is_verify'],
                'updated_by'    => $data['user_id'] ?? NULL,
                'updated_at'    => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData('vendor', ['uid' => $productUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Password Update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'product verify successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }


    public function productOrdering($data)
    {
        $validationRules = [
            'uid'  => 'required',
            'sort' => 'required|integer',
        ];

        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }

        $productUid   = $data['uid'];
        $newSortOrder = (int) ($data['sort'] ?? 0);

        try {
            $updateData = [
                'sort_order' => $newSortOrder,
                'updated_by' => $data['user_id'] ?? null,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData('product', ['uid' => $productUid], $updateData);

            if (!$success) {
                return [
                    false,
                    500,
                    'Product update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'Product sort order updated successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }


    public function getExcelData()
    {
        $products = $this->apiModel->getAllProducstData();
        $customers = $this->apiModel->getAllCustomersData();
        $ratings   = $this->apiModel->getAllRatingsData();
        $vendors = $this->apiModel->getAllVendorsData();

        return [
            true,
            200,
            'Excel Sheet Import Datas.',
            [

                'products' => $products,
                'customers' => $customers,
                'ratings' => $ratings,
                'vendors' => $vendors,

            ]
        ];
    }

    public function editProduct($data, $file)
    {
        $validationRules = [
            'uid'        => 'required',
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $productUid = generateUid();
        $timestamp = timestamp();
        $image_paths = [];
        if (isset($file['images']) && is_array($file['images'])) {
            foreach ($file['images'] as $singleFile) {
                if ($singleFile->isValid() && !$singleFile->hasMoved()) {
                    $uploadResult = uploadFile($singleFile, 'products', generateUid());
                    if (isset($uploadResult['error'])) {
                        return [
                            'status'     => 'failed',
                            'statusCode' => 400,
                            'message'    => 'One or more file uploads failed',
                            'errors'     => ['products Image' => $uploadResult['error']],
                        ];
                    }
                    $image_paths[] = $uploadResult['path'];
                }
            }
        }
        $product = $this->db->table('product')->select('vendor_id')->where('uid', $data['uid'])->get()->getRow();
        try {
            $image_path = $image_paths[0] ?? '';
            $addData = [
                'name'              => $data['name'],
                'description'       => $data['description'],
                'price'             => $data['product_price'] ?? 1000,
                'brand'             => $data['product_brand'] ?? null,
                'html_description'  => $data['content'] ?? "",
                'vendor_id'         => $product->vendor_id,
                'category_id'       => $data['category'],
                'subcategory_id'    => $data['subcategory'] ?? null,
                'image'             => '',
                'created_by'        => $data['user_id'] ?? NULL,
                'is_admin_allow'    => 0,
            ];
            $success = $this->commonModel->UpdateData(PRODUCT_TABLE, ['uid' => $data['uid']], $addData);


            if (!empty($image_paths)) {

                $this->db->table(PRODUCT_IMAGE_TABLE)
                    ->where('product_id', $data['uid'])
                    ->set('main_image', 0)
                    ->update();

                foreach ($image_paths as $imgPath) {
                    $mainImageValue = ($imgPath === $image_path) ? 1 : 0;
                    $addImage = [
                        'uid'         => generateUid(),
                        'product_id'  => $data['uid'],
                        'main_image'  => $mainImageValue,
                        'image'       => $imgPath,
                        'created_by'  => $data['user_id'] ?? NULL,
                    ];
                    $this->commonModel->insertData(PRODUCT_IMAGE_TABLE, $addImage);
                }
            }

            if (!$success) {
                return [
                    false,
                    500,
                    'Product Data edit failed.',
                    ['error' => 'Database edit failed']
                ];
            }
            return [
                true,
                200,
                'Product Data edit successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }

    public function deleteProductImage($data)
    {
        $validationRules = [
            'uid' => 'required',
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }

        $imageUid = $data['uid'];

        try {
            $image = $this->db->table(PRODUCT_IMAGE_TABLE)
                ->where('uid', $imageUid)
                ->get()
                ->getRowArray();

            if (!$image) {
                return [false, 404, 'Image not found', ['image_not_found']];
            }
            $success = $this->commonModel->UpdateData(
                PRODUCT_IMAGE_TABLE,
                ['uid' => $imageUid],
                ['status' => DELETED_STATUS]
            );

            if (!$success) {
                return [false, 500, 'Product Image Delete failed.', ['db_error']];
            }

            if ((int)$image['main_image'] === 1) {
                $this->commonModel->UpdateData(
                    PRODUCT_IMAGE_TABLE,
                    ['uid' => $imageUid],
                    ['main_image' => 0]
                );
            }

            return [true, 200, 'Product Image deleted successfully.', []];
        } catch (\Throwable $e) {
            log_message('error', 'Image delete error: ' . $e->getMessage());
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
}
