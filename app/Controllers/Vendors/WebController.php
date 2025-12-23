<?php

namespace App\Controllers\Vendors;

use App\Controllers\Common;
use App\Services\Vendors\WebService;
use App\Services\Vendors\ProductService;
use App\Models\CommonModel;
use App\Models\Vendors\WebModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class WebController extends Common
{
    protected $webService;
    protected $commonModel;
    public function __construct()
    {
        $this->session = session();
        $this->webService = new WebService();
        $this->commonModel = new CommonModel();
        $this->webModel = new WebModel();
    }

    /** Index */
    public function index()
    {
        $jwt = $this->request->getCookie(VENDOR_JWT_TOKEN);

        if (empty($jwt)) {
            return view('vendors/login.php');
        }
        $data = validateJWT($jwt);
        if (!$data) {
            return view('vendors/login.php');
        }
        return redirect()->to(base_url('vendor/products'));
    }

    /** Dashboard */
    public function dashboard()
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }

        return
            view('vendors/templates/header.php') .
            view('vendors/dashboard.php') .
            view('vendors/templates/footer.php');
    }

    /** Products */
    public function products()
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }
        $resp['category'] = $this->commonModel->getAllData(CATEGORY_TABLE, ['status' => ACTIVE_STATUS]);
        $resp['resp'] = $this->webService->getProductsDetails($payload->user_id);
        // $this->dd($resp) ; 
        return
            view('vendors/templates/header.php') .
            view('vendors/products.php', $resp) .
            view('vendors/templates/footer.php');
    }
    public function add_product()
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }
        $resp['category'] = $this->commonModel->getCategory();
        $resp['resp'] = $this->webService->getProductsDetails($payload->user_id);


        return
            view('vendors/templates/header.php') .
            view('vendors/add_product.php', $resp) .
            view('vendors/templates/footer.php');
    }

    /** Change Password */
    public function changePassword()
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }
        return
            view('vendors/templates/header.php') .
            view('vendors/change_password.php') .
            view('vendors/templates/footer.php');
    }

    /** Profile */
    public function profile()
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }
        $resp['resp'] = $this->commonModel->getSingleData(VENDOR_TABLE, ['uid' => $payload->user_id, 'status !=' => DELETED_STATUS]);
        // echo '<pre>';
        // print_r($resp);
        // die;
        return
            view('vendors/templates/header.php') .
            view('vendors/profile.php', $resp) .
            view('vendors/templates/footer.php');
    }

    /** Update Profile */
    public function edit_profile()
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }
        $resp['resp'] = $this->commonModel->getSingleData(VENDOR_TABLE, ['uid' => $payload->user_id, 'status !=' => DELETED_STATUS]);

        return
            view('vendors/templates/header.php') .
            view('vendors/edit_profile.php', $resp) .
            view('vendors/templates/footer.php');
    }

    /** View Product Details */
    public function view_product($productId)
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }
        $resp['resp'] = $this->webService->getProductsDetailsByProductId($payload->user_id, $productId);
        $resp['images'] = $this->webModel->getProductImage($productId);
        $resp['category'] = $this->commonModel->getCategory();
        return
            view('vendors/templates/header.php') .
            view('vendors/view_product.php', $resp) .
            view('vendors/templates/footer.php');
    }

    /** Requests */
    public function requests()
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }

        $vendorId = $payload->user_id;

        $customerUid = $this->request->getGet('customer');
        $productUid  = $this->request->getGet('product');
        $date        = $this->request->getGet('date');

        // Fetch request list (with joined customer/product/etc.)
        $requests = $this->webService->getRequestsDetails(
            $vendorId,
            $customerUid,
            $productUid,
            $date
        );

        // Payment service
        $paymentService = new \App\Services\Vendors\PaymentService();

        // Add is_paid field for each request
        foreach ($requests as &$row) {
            $leadUid = $row['uid'];

            $payment = $paymentService->getPaymentByRequestId($leadUid);

            $row['is_paid'] = ($payment && $payment['status'] === 'success');
        }

        // Dropdown filters
        $customers = $this->commonModel->getAllData(CUSTOMER_TABLE, ['status' => ACTIVE_STATUS]);
        $products  = $this->commonModel->getAllData(PRODUCT_TABLE, ['status' => ACTIVE_STATUS]);

        // Final response array
        $data = [
            'vendor_id'   => $vendorId,
            'customerUid' => $customerUid,
            'productUid'  => $productUid,
            'date'        => $date,

            'requests'    => $requests,
            'customers'   => $customers,
            'products'    => $products,
        ];

        return view('vendors/templates/header.php')
            . view('vendors/requests.php', $data)
            . view('vendors/templates/footer.php');
    }


    /** Ratings */
    public function ratings()
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }
        $resp['customerUid'] = $this->request->getGet('customer');
        $resp['productUid'] = $this->request->getGet('product');
        $resp['customer'] = $this->commonModel->getAllData(CUSTOMER_TABLE, ['status' => ACTIVE_STATUS]);
        $resp['product'] = $this->commonModel->getAllData(PRODUCT_TABLE, ['status' => ACTIVE_STATUS]);
        $resp['resp'] = $this->webService->getCustomerReview($payload->user_id, $resp['customerUid'], $resp['productUid']);
        return
            view('vendors/templates/header.php') .
            view('vendors/ratings.php', $resp) .
            view('vendors/templates/footer.php');
    }

    /** Logout */
    public function logout()
    {
        $auth_cookie   = deleteJwtToken(VENDOR_JWT_TOKEN);
        return redirect()
            ->to(base_url('vendor/login'))
            ->setCookie($auth_cookie);
    }


    /**Bulk Upload **/
    public function bulkUploadForm()
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }

        // Load categories if needed in the form
        $resp['category'] = $this->commonModel->getCategory();

        return
            view('vendors/templates/header.php') .
            view('vendors/bulk_upload.php', $resp) .
            view('vendors/templates/footer.php');
    }


    public function bulkUploadSubmit()
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }

        $file = $this->request->getFile('excel_file');

        if (!$file || !$file->isValid()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Please upload a valid Excel file.'
            ]);
        }

        try {
            // Load your product service
            $productService = new \App\Services\Vendors\ProductService();
            $result = $productService->bulkUploadFromExcel($file, $payload->user_id);

            if (!empty($result['success'])) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => $result['message'] ?? 'Products uploaded successfully.'
                ]);
            }

            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'message' => $result['message'] ?? 'Upload failed.',
                'errors'  => $result['errors'] ?? []
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'Bulk upload error: ' . $e->getMessage());

            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Server error occurred: ' . $e->getMessage()
            ]);
        }
    }
}
