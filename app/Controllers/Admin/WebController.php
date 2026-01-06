<?php

namespace App\Controllers\Admin;

use App\Controllers\Common;
use App\Services\Admin\WebService;
use App\Models\CommonModel;
use App\Models\Vendors\WebModel as vendorModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use App\Models\Customer\WebModel as customerModel;
use App\Models\Admin\WebModel as adminWebModel;

class WebController extends Common
{
    protected $webService;
    protected $commonModel;
    protected $db;
    protected $vendorWebModel;
    protected $customerModel;
    protected $adminWebModel;
    public function __construct()
    {
        $this->session = session();
        $this->webService = new WebService();
        $this->commonModel = new CommonModel();
        $this->db =   \Config\Database::connect();
        $this->vendorWebModel = new vendorModel();
        $this->customerModel =  new customerModel();
        $this->adminWebModel = new adminWebModel();
    }

    /** Index */
    public function index()
    {
        $jwt = $this->request->getCookie(ADMIN_JWT_TOKEN);
        if (empty($jwt)) {
            return view('admin/login.php');
        }
        $data = validateJWT($jwt);
        if (!$data) {
            return view('admin/login.php');
        }
        return redirect()->to(base_url('admin/dashboard'));
    }

    /** Dashboard */
    public function dashboard()
    {
        $payload = $this->validateJwtWebToken();
        if (!$payload) {
            return redirect()->to(base_url('admin/login'));
        }
        $data['matrics'] = $this->customerModel->getStatics();
        $data['requests'] = $this->adminWebModel->getRequestsDetails(null, null, null, null);
        // $this->dd($data) ; 
        return
            view('admin/templates/header.php') .
            view('admin/dashboard.php', $data) .
            view('admin/templates/footer.php');
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

        $resp['category'] = $this->commonModel->getAllData(CATEGORY_TABLE, ['status' => ACTIVE_STATUS, 'path' => '']);
        //$resp['resp'] = $this->commonModel->getAllData(CATEGORY_TABLE,['status !=' => DELETED_STATUS]);
        $resp['resp'] = $this->webService->getCategoryData();
        // print_r($resp['resp']) ; die ; 

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
        // $this->dd($resp);
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

    public function view_vendor_details()
    {
        $payload = $this->validateJwtWebToken();
        if (!$payload) {
            return redirect()->to(base_url('admin/login'));
        }
        $vendorId = $this->request->getGet('vendorId');
        $resp['resp'] = $this->commonModel->getSingleData(VENDOR_TABLE, ['uid' => $vendorId, 'status !=' => DELETED_STATUS]);
        return
            view('admin/templates/header.php') .
            view('admin/vendor_details.php', $resp) .
            view('admin/templates/footer.php');
    }

    /** Requests */
    public function requests()
    {
        $payload = $this->validateJwtWebToken();
        if (!$payload) {
            return redirect()->to(base_url('admin/login'));
        }
        $resp['vendorUid'] = $this->request->getGet('vendor');
        $resp['customerUid'] = $this->request->getGet('customer');
        $resp['productUid'] = $this->request->getGet('product');
        $resp['date'] = $this->request->getGet('date');

        $resp['resp'] = $this->webService->getRequestsDetails($resp['vendorUid'], $resp['customerUid'], $resp['productUid'], $resp['date']);
        $resp['vendor'] = $this->commonModel->getAllData(VENDOR_TABLE, ['status' => ACTIVE_STATUS]);
        $resp['customer'] = $this->commonModel->getAllData(CUSTOMER_TABLE, ['status' => ACTIVE_STATUS]);
        $resp['product'] = $this->commonModel->getAllData(PRODUCT_TABLE, ['status' => ACTIVE_STATUS]);


        return
            view('admin/templates/header.php') .
            view('admin/requests.php', $resp) .
            view('admin/templates/footer.php');
    }

    /** Ratings */
    public function ratings()
    {
        $payload = $this->validateJwtWebToken();
        if (!$payload) {
            return redirect()->to(base_url('admin/login'));
        }
        $resp['customerUid'] = $this->request->getGet('customer');
        $resp['productUid'] = $this->request->getGet('product');
        $resp['customer'] = $this->commonModel->getAllData(CUSTOMER_TABLE, ['status' => ACTIVE_STATUS]);
        $resp['product'] = $this->commonModel->getAllData(PRODUCT_TABLE, ['status' => ACTIVE_STATUS]);
        $resp['resp'] = $this->webService->getCustomerReview($resp['customerUid'], $resp['productUid']);

        return
            view('admin/templates/header.php') .
            view('admin/ratings.php', $resp) .
            view('admin/templates/footer.php');
    }


    public function metaContent()
    {
        $payload = $this->validateJwtWebToken();
        if (!$payload) {
            return redirect()->to(base_url('admin/login'));
        }
        $getAllTags = $this->db->table('meta_tags')->orderBy('id', 'desc')->where('status', 'active')->get()->getResultArray();
        $data['metaDeatils'] =  $getAllTags;
        // $this->dd($data);
        return
            view('admin/templates/header.php') .
            view('admin/seo_tags.php', $data) .
            view('admin/templates/footer.php');
    }

    /** Logout */
    public function logout()
    {
        $auth_cookie   = deleteJwtToken(ADMIN_JWT_TOKEN);
        return redirect()
            ->to(base_url('admin/login'))
            ->setCookie($auth_cookie);
    }

    public function view_product($productId)
    {

        $payload = $this->validateJwtWebToken();
        if (!$payload) {
            return redirect()->to(base_url('admin/login'));
        }
        // // $productId = $this->request->getGet('productId');
        // echo  $productId;
        $resp['resp'] = $this->webService->getProductsDetailsByProductId($productId);
        $resp['images'] = $this->vendorWebModel->getProductImage($productId);
        $resp['category'] = $this->commonModel->getCategory();

        // $this->dd($resp);
        return
            view('admin/templates/header.php') .
            view('admin/view_product.php', $resp) .
            view('admin/templates/footer.php');
    }

    public function getSubCategories()
    {
        $parentUid = $this->request->getPost('parent_uid');

        if (empty($parentUid)) {
            return $this->response->setJSON([
                'success' => false,
                'data' => []
            ]);
        }

        $subCategories = $this->db->table('category')
            ->select('uid, title')
            ->where('path', $parentUid)
            ->where('status', 'active')
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'success' => true,
            'data' => $subCategories
        ]);
    }


    public function getCategories()
    {
        $categories = $this->db->table('category')->get()->getResultArray();
        $tree = $this->buildTree($categories);

        $this->apiSuccess(
            200,
            'category tree',
            $tree
        );
    }



    private function buildTree($elements, $parentId = null)
    {
        $branch = [];
        foreach ($elements as $element) {
            $elementParent = $element['path'] === "" ? null : $element['path'];

            if ($elementParent == $parentId) {
                $children = $this->buildTree($elements, $element['uid']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public function send_email()
    {
        helper(['form']);

        $email = \Config\Services::email();

        try {

            $to      = $this->request->getPost('to') ?? 'nv543578@gmail.com';
            $subject = $this->request->getPost('subject') ?? 'Test Email';
            $message = $this->request->getPost('message') ?? 'Hi! This is a test email.';
            echo "Request Email : <b>{$to}</b>";

            $email->setFrom('admin@foundrybiz.com', 'FoundryBiz');
            $email->setTo($to);
            $email->setSubject($subject);
            $email->setMessage($message);


            if ($email->send(false)) {
                echo "✅ Email sent successfully to: <b>{$to}</b>";
            } else {

                $error = $email->printDebugger(['headers', 'subject', 'body']);
                log_message('error', 'Email send failed: ' . print_r($error, true));

                echo "❌ Email failed to send.<br><br>";
                echo "<pre>" . print_r($error, true) . "</pre>";
            }
        } catch (\Exception $e) {


            echo "⚠️ Email sending error: " . $e->getMessage();
        }
    }
}
