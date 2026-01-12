<?php

namespace App\Models\Vendors;

use CodeIgniter\Model;

class WebModel extends Model
{

    public function getProductsDetails($vendorId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product p');
        $builder->select('
            p.*, 
            v.name AS vendor_name, 
            c.title AS category_name , 
            s.title as subcategory_name
        ');
        $builder->join('vendor v', 'v.uid = p.vendor_id', 'left');
        $builder->join('category c', 'c.uid = p.category_id', 'left');
        $builder->join('category s', 's.uid = p.subcategory_id', 'left');
        $builder->orderBy('p.created_at', 'desc');
        $builder->where('p.status !=', DELETED_STATUS);
        $builder->where('p.vendor_id', $vendorId);

        $result = $builder->get()->getResultArray();
        return $result;
    }

    public function getProductsDetailsByProductId($vendorId, $productId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product p');
        $builder->select('
            p.*, 
            v.name AS vendor_name, 
            c.title AS category_name,
            ps.meta_title,
            ps.meta_description,
            ps.meta_keywords,
            ps.meta_tags
        ');
        $builder->join('vendor v', 'v.uid = p.vendor_id', 'left');
        $builder->join('category c', 'c.uid = p.category_id', 'left');
        $builder->join('product_seo ps', 'ps.product_uid = p.uid', 'left');
        $builder->orderBy('p.created_at', 'desc');
        $builder->where('p.status !=', DELETED_STATUS);
        $builder->where('p.vendor_id', $vendorId);
        $builder->where('p.uid', $productId);

        $result = $builder->get()->getRowArray();
        return $result;
    }

    public function getRequestsDetails($vendorId, $customer = null, $product = null, $date = null)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('request r');

        $builder->select('
        r.*,
        c.name AS customer_name,
        c.mobile AS customer_mobile,
        c.email AS customer_email,
        p.name AS product_name,
        v.name AS vendor_name,
        pi.image AS product_image
    ');

        // CORRECT JOINS BASED ON YOUR SCREENSHOT
        $builder->join('customer c', 'c.uid = r.customer_id', 'left');
        $builder->join('product p',  'p.uid = r.product_id', 'left');
        $builder->join('vendor v',   'v.uid = r.vendor_id', 'left');

        // FIX PRODUCT IMAGE JOIN
        $builder->join('product_image pi', 'pi.product_id = p.uid', 'left');

        // FILTERS
        $builder->where('r.vendor_id', $vendorId);

        if ($customer !== null) {
            $builder->where('r.customer_id', $customer);
        }

        if ($product !== null) {
            $builder->where('r.product_id', $product);
        }

        if ($date !== null) {
            $builder->where('DATE(r.created_at)', $date);
        }

        return $builder->get()->getResultArray();
    }





    public function getCustomerReview($vendorId = null, $customerId = null, $productId = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product_rating pr');
        $builder->select('
            pr.*, 
            c.name AS customer_name, 
            c.image AS customer_image, 
            c.mobile AS customer_mobile, 
            c.email AS customer_email, 
            p.name AS product_name
        ');
        $builder->join('customer c', 'c.uid = pr.customer_id', 'left');
        $builder->join('product p', 'p.uid = pr.product_id', 'left');
        $builder->where('pr.status', ACTIVE_STATUS);
        if ($customerId != null) {
            $builder->where('pr.customer_id', $customerId);
        }
        if ($productId != null) {
            $builder->where('pr.product_id', $productId);
        }
        if ($vendorId != null) {
            $builder->where('p.vendor_id', $vendorId);
        }
        $builder->orderBy('pr.created_at',  'desc');
        $result = $builder->get()->getResultArray();
        return $result;
    }


    public function getProductImage($productId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product_image');
        $builder->select('*');
        $builder->where('product_id', $productId);
        $builder->where('status', ACTIVE_STATUS);
        $result = $builder->get()->getResultArray();
        return $result;
    }
}
