<?php

namespace App\Controllers\Customer;

use App\Controllers\Common;
use App\Services\Customer\WebService;
use App\Models\CommonModel;
use App\Models\Customer\WebModel;


use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class WebController extends Common
{
    protected $webService;
    protected $commonModel;
    protected $webmodel;
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->session= session();
        $this->webService = new WebService();
        $this->commonModel = new CommonModel();
        $this->webmodel = new WebModel();
        $this->db =   \Config\Database::connect();
    }

    public function isCustomerLoggedIn()
    {
        $payload = $this->validateJwtWebTokenCustomer();
        return !empty($payload);
    }


    /** Index */
    public function index()
    {
        $resp['category'] = $this->commonModel->getCategory();
        //$resp['product'] = $this->commonModel->getAllData(PRODUCT_TABLE,['status' => ACTIVE_STATUS]);
        $resp['product'] = $this->webService->getAllProductDetails();
        $this->webService->getCustomerReview();
        
        // $targetCount = 20;
        // while (count($resp['product']) < $targetCount) {
        //     foreach ($resp['product'] as $p) {
        //         if (count($resp['product']) >= $targetCount) break;
        //         $resp['product'][] = $p; // duplicate same product
        //     }
        // }
        $resp['statics'] = $this->webmodel->getStatics();
        $homePageMetaTags = $this->db->table('meta_tags')->where('page_name', 'home')->get()->getRow();
        $metaTags = [
            'meta_title' => !empty($homePageMetaTags->title) ?  $homePageMetaTags->title  : 'Home',
            'meta_description' => !empty($homePageMetaTags->description) ?  $homePageMetaTags->description  : ''
            
        ];
        $resp['customerLoggedIn'] = $this->isCustomerLoggedIn();

        return
            view('customer/templates/header.php', $metaTags) .
            view('customer/home.php', $resp) .
            view('customer/templates/footer.php');
    }

    /** Product List */
    public function product_list()
    {
        $filterData = [];
        $filter = $this->request->getGet('filter');

        if ($filter) {
            $decoded = base64_decode($filter);
            $filterData = json_decode($decoded, true); // associative array
            // echo '<pre>';
            // var_dump($filterData);
            // die();
            $resp['categoryUid'] =    $filterData['categories'];
            $resp['priceFrom'] = $filterData['price']['from'];
            $resp['priceTo'] = $filterData['price']['to'];
            $resp['name'] = $filterData['name'] ?? '';
            $resp['countries'] = $filterData['countries'] ?? '';
            $resp['vendor_type'] = $filterData['vendorStatus'] ?? '';
        } else {
            $resp['name'] = '';
            $resp['categoryUid'] = [];
            $resp['priceFrom'] = 100;
            $resp['priceTo'] = 50000;
            $resp['countries'] = [];
            $resp['vendor_type'] = '';
        }
        $db = \Config\Database::connect();
        

        // $resp['category'] = $this->commonModel->getAllData(CATEGORY_TABLE, ['status' => ACTIVE_STATUS]);
        $builder = $db->table(CATEGORY_TABLE);
        $builder->select('*');
        $builder->where('status', ACTIVE_STATUS);
        $query = $builder->get();
        $categories = $query->getResultArray();

        
        $categoryTree = [];
        foreach ($categories as $category) {
            if (empty($category['path'])) {
                
                $categoryTree[$category['uid']] = $category;
                $categoryTree[$category['uid']]['subcategories'] = [];
            }
        }

        foreach ($categories as $subcategory) {
            if (!empty($subcategory['path']) && isset($categoryTree[$subcategory['path']])) {
                $categoryTree[$subcategory['path']]['subcategories'][] = $subcategory;
            }
        }

        $resp['category'] =  $categoryTree;
        //$resp['product'] = $this->webService->getProductList($resp['categoryUid'],$resp['priceFrom'],$resp['priceTo']);
        $resp['product'] = $this->webService->getFilteredProductDetails(
            $resp['categoryUid'],
            $resp['priceFrom'],
            $resp['priceTo'],
            $resp['countries'],
            $resp['vendor_type']
        );
        // echo '<pre>';
        //     var_dump($resp['product']);
        //     die();


        $resp['review'] = $this->webService->getCustomerReview();
        $resp['vendorCountryList'] = $this->webmodel->getVendorCountryList();


        $metaTags = [
            'meta_title' => 'Product Filter',
            'meta_description' => 'Equip your project with the best. Foundry offers a full range of heavy-duty machines and commercial equipment built for performance and durability. Find the power you need, delivered straight to your site'
        ];
        
        $resp['vendorCountryList'] = $this->webmodel->getVendorCountryList();
        $resp['customerLoggedIn'] = $this->isCustomerLoggedIn();
        //  dd($resp['customerLoggedIn']);


        // echo'<pre>';
        // print_r($resp);
        // die;
        return
            view('customer/templates/header.php', $metaTags) .
            view('customer/product_list.php', $resp) .
            view('customer/templates/footer.php');
    }

    /** Category Product */
    public function category_product()
    {
        $metaTags = [
            'meta_title' => 'Product Category',
            'meta_description' => 'Equip your project with the best. Foundry offers a full range of heavy-duty machines and commercial equipment built for performance and durability. Find the power you need, delivered straight to your site'
        ];
        $resp['category'] = $this->commonModel->getCategory();
        $resp['product'] = $this->commonModel->getAllData(PRODUCT_TABLE, ['status' => ACTIVE_STATUS]);
        $resp['review'] = $this->webService->getCustomerReview();
        return
            view('customer/templates/header.php', $metaTags) .
            view('customer/category.php', $resp) .
            view('customer/templates/footer.php');
    }

    /** Product Details */
    public function product_details($slug)
    {


        $db = \Config\Database::connect();
        $payload = $this->validateJwtWebTokenCustomer();
        // echo '<pre>';
        // print_r($payload);
        // die;
        if (!empty($payload)) {
            $resp['customerDetails'] = [
                'user_id' => $payload->user_id,
                'name' => $payload->user_name,
                'email' => $payload->user_email,
                'phone' => $payload->user_mobile
            ];
        } else {
            $resp['customerDetails'] = [];
        }
        $getSingleProductUid = $db->table('product')->where('slug', $slug)->get()->getRow();
            // print_r($getSingleProductUid);
            // die;
        if (empty($getSingleProductUid) && $getSingleProductUid === null) {
            $getSingleProductUid = $db->table('product')->where('uid', $slug)->get()->getRow();
            $productId = $getSingleProductUid->uid;
        }
        $productId = $getSingleProductUid->uid;

        $resp['resp'] = $this->webService->getProductDetailsByProductId($productId);

        $resp['reviews'] = $this->webService->getCustomerReviewByProductId($productId);

        // $resp['product'] = $this->commonModel->getAllData(PRODUCT_TABLE, ['category_id' => $resp['resp']['category_id'], 'status' => ACTIVE_STATUS]);
        $categoryUID = $resp['resp']['category_id'];



        $resp['product'] = $this->webmodel->getAllMightBeProductDetails($categoryUID);
        $vendorUid = $resp['product'][0]['vendor_id'] ?? null;

        // $isMatch = in_array($categoryUID, array_column($resp['product'], 'uid')) ? 1 : 0;
        // $metaTags = [
        //     'meta_title' => 'Product Details',
        //     'meta_description' => 'Equip your project with the best. Foundry offers a full range of heavy-duty machines and commercial equipment built for performance and durability. Find the power you need, delivered straight to your site'
        // ];

        $productSeo = $this->db->table('product_seo')
            ->where('product_uid', $productId)
            ->where('status', 'active')
            ->get()
            ->getRowArray();

        $metaTags = [
            'meta_title' => !empty($productSeo['meta_title'])
                ? $productSeo['meta_title']
                : ($resp['resp']['name'] ?? 'Product Details'),

            'meta_description' => !empty($productSeo['meta_description'])
                ? $productSeo['meta_description']
                : substr(strip_tags($resp['resp']['description'] ?? ''), 0, 160),

            'meta_keywords' => $productSeo['meta_keywords'] ?? '',
            'meta_tags'     => $productSeo['meta_tags'] ?? '',
        ];



        if (!empty($vendorUid)) {
            $resp['vendor'] = $this->commonModel->getAllData(
                VENDOR_TABLE,
                ['uid' => $vendorUid],
            );
        }
        // echo '<pre>';
        // print_r($resp);
        // die;
        // $this->dd($resp) ; 
        return
            view('customer/templates/header.php', $metaTags) .
            view('customer/product_details.php', $resp) .
            view('customer/templates/footer.php');
    }


    /** Register */
    public function registration()
    {
        return
            view('customer/templates/header.php') .
            view('customer/registration.php') .
            view('customer/templates/footer.php');
    }

    /** Vendor */
    public function vendors()
    {
        $payload = $this->validateJwtWebToken();
        if (!$payload) {
            return redirect()->to(base_url('admin/login'));
        }

        $resp['resp'] = $this->commonModel->getAllData(VENDOR_TABLE, ['status !=' => DELETED_STATUS]);
        return
            view('admin/templates/header.php') .
            view('admin/vendor.php', $resp) .
            view('admin/templates/footer.php');
    }

    /** customers */
    public function customers()
    {
        $payload = $this->validateJwtWebToken();
        if (!$payload) {
            return redirect()->to(base_url('admin/login'));
        }

        $resp['resp'] = $this->commonModel->getAllData(CUSTOMER_TABLE, ['status !=' => DELETED_STATUS]);
        return
            view('admin/templates/header.php') .
            view('admin/customer.php', $resp) .
            view('admin/templates/footer.php');
    }

    /** category */
    public function category()
    {
        $payload = $this->validateJwtWebToken();
        if (!$payload) {
            return redirect()->to(base_url('admin/login'));
        }

        $resp['category'] = $this->commonModel->getAllData(CATEGORY_TABLE, ['status' => ACTIVE_STATUS]);
        //$resp['resp'] = $this->commonModel->getAllData(CATEGORY_TABLE,['status !=' => DELETED_STATUS]);
        $resp['resp'] = $this->webService->getCategoryData();
        return
            view('admin/templates/header.php') .
            view('admin/category.php', $resp) .
            view('admin/templates/footer.php');
    }

    /** Products */
    public function products()
    {
        $payload = $this->validateJwtWebToken();
        if (!$payload) {
            return redirect()->to(base_url('admin/login'));
        }
        $resp['resp'] = $this->webService->getProductsDetails();

        return
            view('admin/templates/header.php') .
            view('admin/products.php', $resp) .
            view('admin/templates/footer.php');
    }


    /** Change Password */
    public function changePassword()
    {
        $payload = $this->validateJwtWebToken();
        if (!$payload) {
            return redirect()->to(base_url('admin/login'));
        }
        return
            view('admin/templates/header.php') .
            view('admin/change_password.php') .
            view('admin/templates/footer.php');
    }

    /** View Product Details */
    public function view_product()
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }
        $productId = $this->request->getGet('productId');
        $resp['resp'] = $this->webService->getProductsDetailsByProductId($productId);
        return
            view('admin/templates/header.php') .
            view('admin/view_product.php', $resp) .
            view('admin/templates/footer.php');
    }

    /** View vendor Details */
    public function view_vendor_details()
    {
        $payload = $this->validateJwtWebTokenVendor();
        if (!$payload) {
            return redirect()->to(base_url('vendor/login'));
        }
        $vendorId = $this->request->getGet('vendorId');
        $resp['resp'] = $this->commonModel->getSingleData(VENDOR_TABLE, ['uid' => $vendorId, 'status !=' => DELETED_STATUS]);
        return
            view('admin/templates/header.php') .
            view('admin/vendor_details.php', $resp) .
            view('admin/templates/footer.php');
    }

    /** Product List */
    public function vendor_register()
    {
        return
            view('customer/templates/header.php') .
            view('customer/vendor_register.php') .
            view('customer/templates/footer.php');
    }

    /** Logout */
    public function logout()
    {
        $auth_cookie   = deleteJwtToken(CUSTOMER_JWT_TOKEN);
        return redirect()
            ->to(base_url())
            ->setCookie($auth_cookie);
    }

    public function getCategory()
    {
        $db = \Config\Database::connect();
        $builder = $db->table(CATEGORY_TABLE);
        $builder->groupStart()
            ->where('path', '')     // Empty string
            ->orWhere('path IS NULL', null, false) // NULL value
            ->groupEnd();
        $builder->where(['status' => ACTIVE_STATUS]);
        return $builder->get()->getResultArray();
    }
}

