<?php

namespace App\Services\Vendors;

use CodeIgniter\Validation\Validation;

use App\Models\CommonModel;
use App\Models\Vendors\ApiModel;

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

            return [true, 200, "Login successfully", ["data" => $success]];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    /** Login */

    /** Product Section */
    public function createdProduct($data, $file)
    {
        $validationRules = [
            'name'        => 'required',
            'category'    => 'required',
            'description' => 'required',

        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $productUid = generateUid();
        $timestamp = timestamp();
        // Handle file upload
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

        try {
            $name = $data['name'];

            $slug = $this->generateUniqueSlug($name, $data['user_id']);

            $image_path = $image_paths[0] ?? '';
            $addData = [
                'uid'               => $productUid,
                'name'              => $name,
                'slug'              => $slug,
                'description'       => $data['description'],
                'price'             => $data['product_price'] ?? 1000,
                'brand'             => $data['product_brand'] ?? null,
                'html_description'  => $data['content'],
                'vendor_id'         => $data['user_id'],
                'category_id'       => $data['category'],
                'subcategory_id'    => $data['subcategory'] ?? null,
                'image'             => '',
                'created_by'        => $data['user_id'] ?? NULL,
            ];
            $success = $this->commonModel->insertData(PRODUCT_TABLE, $addData);
            $seoData = [
                'uid'              => generateUid(),
                'product_uid'      => $productUid,
                'meta_title'       => $data['meta_title'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
                'meta_keywords'    => $data['meta_keywords'] ?? null,
                'tags'             => $data['tags'] ?? null,
                'status'           => 'active',
                'created_at'       => $timestamp,
                'updated_at'       => $timestamp
            ];

            if (
                !empty($seoData['meta_title']) ||
                !empty($seoData['meta_description']) ||
                !empty($seoData['meta_keywords']) ||
                !empty($seoData['tags'])
            ) {
                $this->commonModel->insertData('product_seo', $seoData);
            }

            if (!empty($image_paths)) {
                foreach ($image_paths as $imgPath) {
                    $mainImageValue = ($imgPath === $image_path) ? 1 : 0;
                    $addImage = [
                        'uid'         => generateUid(),
                        'product_id'  => $productUid,
                        'image'       => $imgPath,
                        'main_image'  => $mainImageValue,
                        'created_by'  => $data['user_id'] ?? NULL,
                    ];
                    $this->commonModel->insertData(PRODUCT_IMAGE_TABLE, $addImage);
                }
            }
            if (!$success) {
                return [
                    false,
                    500,
                    'Product Data Insert failed.',
                    ['error' => 'Database insert failed']
                ];
            }
            return [
                true,
                200,
                'Product Data Insert successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }



    private function generateUniqueSlug($string, $vendorId = null)
    {


        $slug = strtolower($string);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        $slug = trim($slug, '-');

        $originalSlug = $slug;
        $i = 1;

        $builder = $this->db->table('product')->select('slug');

        if ($vendorId) {
            $builder->where('vendor_id', $vendorId);
        }

        while ($builder->where('slug', $slug)->countAllResults() > 0) {
            $slug = $originalSlug . '-' . $i;
            $i++;
            $builder = $this->db->table('product')->select('slug');
            if ($vendorId) {
                $builder->where('vendor_id', $vendorId);
            }
        }

        return $slug;
    }
    public function updateProduct($data, $file)
    {
        $validationRules = [
            'name'        => 'required',
            'category'    => 'required',
            'description' => 'required'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $productUid = $data['productUid'];
        $timestamp = timestamp();
        // Handle file upload
        $uploadResult = null;
        $image_path = '';
        if ($file && $file->isValid() && !$file->hasMoved()) {

            $uploadResult = uploadFile($file, 'product', $timestamp);
            if (isset($uploadResult['error'])) {
                return [
                    'status'     => 'failed',
                    'statusCode' => 400,
                    'message'    => 'File upload failed',
                    'errors'     => ['product Image' => $uploadResult['error']],
                ];
            }
            $image_path = $uploadResult['path'];
        }

        try {
            $updateData = [
                'name'         => $data['name'],
                'description'  => $data['description'],
                'vendor_id'    => $data['user_id'],
                'category_id'  => $data['category'],
                'updated_by'   => $data['user_id'] ?? NULL,
                'updated_at'   => date('Y-m-d H:i:s')
            ];
            if (!empty($image_path)) {
                // $updateData['image'] = $image_path;
                $updateData['image'] = '';
            }

            $success = $this->commonModel->UpdateData(PRODUCT_TABLE, ['uid' => $productUid], $updateData);
            if (!$success) {
                return [
                    false,
                    500,
                    'Product Details Update failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'Product details update successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
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
        $vendorUid = $data['user_id'];

        try {
            $plainPassword = $data['password'];
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
            $updateData = [
                'password'      => $hashedPassword,
                'updated_by'    => $data['user_id'] ?? NULL,
                'updated_at'    => date('Y-m-d H:i:s')
            ];

            $success = $this->commonModel->UpdateData(VENDOR_TABLE, ['uid' => $vendorUid], $updateData);
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

    /** Forgot Password */
    public function forgotPassword($data)
    {
        $validationRules = [
            'email'     => 'required',
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }

        try {
            $success = $this->apiModel->checkAdminLogin($data['email']);
            if (!$success) {
                return [false, 401, 'Email-Id Not Found', ['invalid_credentials']];
            }
            $otp = rand(111111, 999999);
            $uid = generateUid();
            $addData = [
                'uid'          => $uid,
                'user_id'      => $success['uid'],
                'otp'          => $otp,
                'type'         => OTP_LIST_FORGOT_PASSWORD,
            ];
            $this->commonModel->insertData(OTP_LIST_TABLE, $addData);
            $success['otpUid'] = $uid;
            $this->sendVendorForgotPasswordOTP($success['name'], $success['email'], $otp);
            return [
                true,
                200,
                'OTP Send successful',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    private function sendVendorForgotPasswordOTP($name, $email, $otp)
    {
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setFrom(EMAIL, 'Foundry');
        $emailService->setSubject('Your OTP Code');
        $emailService->setMessage(
            "Dear $name,<br>" .
                "Your OTP Code is: <b>$otp</b><br>" .
                "Thank you!"
        );

        if (!$emailService->send()) {
            log_message('error', 'Failed to send password email to ' . $email);
        }
    }
    public function resetPassword($data)
    {
        $validationRules = [
            'otpUid'    => 'required',
            'uid'       => 'required',
            'otp'       => 'required',
            'password'  => 'required',
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }

        try {
            $success = $this->apiModel->checkForgotOtp($data['otpUid'], $data['uid']);
            if (!$success) {
                return [false, 401, 'OTP Not Matched', ['invalid_credentials']];
            }
            if ($success['otp'] != $data['otp']) {
                return [false, 401, 'OTP Not Matched', ['invalid_credentials']];
            }

            $plainPassword = $data['password'];
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
            $updateData = [
                'password'      => $hashedPassword,
                'updated_by'    => $data['user_id'] ?? NULL,
                'updated_at'    => date('Y-m-d H:i:s')
            ];

            $updateSuccess = $this->commonModel->UpdateData(VENDOR_TABLE, ['uid' => $data['uid']], $updateData);
            if (!$updateSuccess) {
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
    /** Forgot Password */

    /** Update Profile */
    public function updateProfile($data, $file)
    {
        $validationRules = [
            'name'      => 'required',
            'email'      => 'required',
            'mobile'      => 'required',
            'country'      => 'required',
            'dob'      => 'permit_empty'
        ];
        $validationResult = validateData($data, $validationRules);
        if (!$validationResult['success']) {
            return [false, $validationResult['status'], $validationResult['message'], $validationResult['errors']];
        }
        $vendorUid = $data['user_id'];
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
                'country'    => $data['country'],
                'name'       => $data['name'],
                'mobile'     => $data['mobile'],
                'email'      => $data['email'],
                'dob'        => $data['dob'] ?? NULL,
                'updated_by' => $data['user_id'] ?? NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (!empty($image_path)) {
                $updateData['image'] = $image_path;
            } else {
                $updateData['image'] = $data['old_filepath'];
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


    public function getSubCategories($categoryId)
    {

        try {
            $subCategories = $this->commonModel->getAllData(CATEGORY_TABLE, ['path' => $categoryId, 'status' => ACTIVE_STATUS]);
            if (empty($subCategories)) {
                return [true, 200, 'No subcategories found', []];
            }
            return [true, 200, 'Subcategories retrieved successfully', ['data' => $subCategories]];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
    }
    /** Update Profile */



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
            $success = $this->commonModel->UpdateData(PRODUCT_IMAGE_TABLE, ['uid' => $imageUid], ['status' => DELETED_STATUS]);

            if (!$success) {
                return [
                    false,
                    500,
                    'Product Image Delete failed.',
                    ['error' => 'Database update failed']
                ];
            }

            return [
                true,
                200,
                'Product Image deleted successfully.',
                ['data' => $success]
            ];
        } catch (\Throwable $e) {
            return [false, 500, 'Unexpected server error occurred', [$e->getMessage()]];
        }
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

        try {
            $image_path = $image_paths[0] ?? '';
            $addData = [
                'name'              => $data['name'],
                'description'       => $data['description'],
                'price'             => $data['product_price'] ?? 1000,
                'brand'             => $data['product_brand'] ?? null,
                'html_description'  => $data['content'] ?? "",
                'vendor_id'         => $data['user_id'],
                'category_id'       => $data['category'],
                'subcategory_id'    => $data['subcategory'] ?? null,
                'image'             => '',
                'created_by'        => $data['user_id'] ?? NULL,
                'is_admin_allow'    => 0,
            ];
            $success = $this->commonModel->UpdateData(PRODUCT_TABLE, ['uid' => $data['uid']], $addData);

            $seoData = [
                'meta_title'       => $data['metaTitle'] ?? null,
                'meta_description' => $data['metaDescription'] ?? null,
                'meta_keywords'    => $data['metaKeywords'] ?? null,
                'tags'             => $data['metaTags'] ?? null,
            ];

            $seoExists = $this->db
                ->table('product_seo')
                ->where('product_uid', $data['uid'])
                ->get()
                ->getRowArray();


            if ($seoExists) {
                $this->commonModel->UpdateData(
                    'product_seo',
                    ['product_uid' => $data['uid']],
                    $seoData
                );
            } else {
                $seoData['uid']         = generateUid();
                $seoData['product_uid'] = $data['uid'];
                $seoData['status']      = 'active';

                $this->commonModel->insertData('product_seo', $seoData);
            }
            
            if (!empty($image_paths)) {

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
}
