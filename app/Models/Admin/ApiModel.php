<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ApiModel extends Model
{
    protected $db;
    public function __construct()
    {

        $this->db  =   \Config\Database::connect();
    }
    public function checkAdminLogin($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table(ADMIN_TABLE);
        $loginDetails = $builder
            ->select('*')
            ->where('email', $email)
            ->where('status', ACTIVE_STATUS)
            ->get()
            ->getRowArray();
        return $loginDetails;
    }

    public function createdVendor($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table(VENDOR_TABLE);

        $success = $builder->insert($data);

        if ($success) {
            return $data;
        } else {
            return false;
        }
    }




    public function getAllProducstData()
    {
        $selectedValues = [
            'P.uid',
            'P.name as productName',
            'P.status as productStatus',
            'P.is_admin_allow as is_admin_allow',
            'P.is_verify as is_verify', // spobnsored
            'P.sort_order as sort_order',
            'P.created_at',
            'P.status as productStatus',
            'V.name as vendorName',
            'C.title as categoryName',
            'SUB.title as subCategoryName',
        ];
        $builder = $this->db->table('product as P ');
        $builder->select($selectedValues);
        $builder->join('category as C', 'C.uid = P.category_id', 'LEFT');
        $builder->join('category as SUB', 'SUB.uid = P.subcategory_id', 'LEFT');
        $builder->join('vendor as V', 'V.uid = P.vendor_id', 'LEFT');

        $products = $builder->get()->getResult();
        $finalResult = [];
        foreach ($products as $product) {
            $finalResult[] = [
                'uid'      => $product->uid,
                'proudct_name' => $product->productName,
                'product_status' => $product->productStatus,
                'product_type' => ($product->is_verify == 1) ? "Sponsored" : "Not Sponsored ",
                'admin_allow' => ($product->is_admin_allow == 1) ? "Allow" : "Not Allow",
                'product_sort_order' => (int) $product->sort_order,
                'vendor_name' => $product->vendorName ?? "N/A",
                'category_name' => $product->categoryName ?? "N/A",
                'subCategory_name' => $product->subCategoryName ?? "N/A",
                'createdAt'  => date('d M Y', strtotime($product->created_at)) ?? "N/A",
            ];
        }
        return $finalResult;
    }

    public function getAllCustomersData()
    {
        $builder = $this->db->table('customer');
        $builder->select('uid, name, mobile, email,  company ,  status , created_at');
        $customers = $builder->get()->getResultArray();

        $finalResult = array_map(function ($customer) {
            return [
                'uid'        => $customer['uid'] ?? "N/A",
                'name'       => $customer['name'] ?? "N/A",
                'mobile'     => $customer['mobile'] ?? "N/A",
                'status'     => $customer['status'] ?? "N/A",
                'company'    => $customer['company'] ?? "N/A",
                'createdAt'  => date('d M Y', strtotime($customer['created_at'])) ?? "N/A",
            ];
        }, $customers);

        return $finalResult;
    }


    public function getAllRatingsData()
    {
        $selectedValues = [
            'P.name as productName',
            'C.name as customerName',
            'PR.rating',
            'PR.review',
            'PR.status',
            "DATE_FORMAT(PR.created_at, '%d %b %Y') as createdAt"
        ];

        $builder = $this->db->table('product_rating as PR');
        $builder->select($selectedValues);
        $builder->join('customer as C', 'C.uid = PR.customer_id', 'LEFT');
        $builder->join('product as P', 'P.uid = PR.product_id', 'LEFT');

        $ratings = $builder->get()->getResult();
        return $ratings;
    }


    public function getAllVendorsData()
    {
        $builder = $this->db->table('vendor');
        $builder
            ->select(
                'uid ,
                 country, image, name,
                 mobile, email, , 
                 created_at, 
                 status, is_verify,  
                company, address, city, states, website, gst'
            );
        $vendors = $builder->get()->getResultArray();
        $finalResult = array_map(function ($vendors) {
            return [
                'uid'        => $vendors['uid'] ?? "N/A",
                'name'       => $vendors['name'] ?? "N/A",
                'mobile'     => $vendors['mobile'] ?? "N/A",
                'status'     => $vendors['status'] ?? "N/A",
                'email'      => $vendors['email'] ?? "N/A",
                'address'    => $vendors['address'] ?? "N/A",
                'city'       => $vendors['city'] ?? "N/A",
                'company'    => $vendors['company'] ?? "N/A",
                'country'    => $vendors['country'] ?? "N/A",
                'website'    => $vendors['website'] ?? "N/A",
                'gst'              => $vendors['gst'] ?: "N/A",
                'is_verify'        => ($vendors['gst'] == 1) ? "Verifed" :  "Not Verifed",
                'createdAt'        => date('d M Y', strtotime($vendors['created_at'])) ?? "N/A",
            ];
        }, $vendors);

        return $finalResult;
    }
}
