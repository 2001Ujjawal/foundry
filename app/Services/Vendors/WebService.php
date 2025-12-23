<?php

namespace App\Services\Vendors;

use CodeIgniter\Validation\Validation;

//use App\Models\PerformanceModule\ReviewModel;
use App\Models\Vendors\WebModel;
use App\Models\CommonModel;

class WebService
{
    protected $validation;
    protected $webModel;
    protected $commonModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->webModel = new WebModel();
        $this->commonModel = new CommonModel();
    }

    public function getProductsDetails($vendorId)
    {
        $data = $this->webModel->getProductsDetails($vendorId);
        return $data;
    }

    public function getProductsDetailsByProductId($vendorId, $productId)
    {
        $data = $this->webModel->getProductsDetailsByProductId($vendorId, $productId);
        return $data;
    }

    public function getRequestsDetails($vendorId, $customer, $product, $date)
    {
        $data = $this->webModel->getRequestsDetails($vendorId, $customer, $product, $date);
        return $data;
    }

    public function getCustomerReview($vendor_id, $customerId, $productId)
    {
        $data = $this->webModel->getCustomerReview($vendor_id, $customerId, $productId);
        return $data;
    }
}
