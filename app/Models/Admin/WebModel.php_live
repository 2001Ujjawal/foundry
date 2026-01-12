<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class WebModel extends Model
{

    /** Get Category Details */
    public function getCategoryData_2()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('category c');
        $builder->select('c.*, cp.title AS path_name');
        $builder->join('category cp', 'cp.uid = c.path', 'left');
        $builder->orderBy('c.created_at', 'desc');
        $builder->where('c.status !=', DELETED_STATUS);
        $result = $builder->get()->getResultArray();

        return $result;
    }

    public function getCategoryData_old()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('category c');
        $builder->select('c.id,c.uid, c.title, c.path,c.image, c.status, c.created_at, c.updated_at, cp.title AS path_name');
        $builder->join('category cp', 'cp.uid = c.path', 'left'); // join parent category
        $builder->where('c.status !=', DELETED_STATUS);
        //$builder->orderBy('c.uid', 'desc');

        $result = $builder->get()->getResultArray();
        echo '<pre>';
        print_r($result);
        die;

        $categories = [];
        foreach ($result as $row) {
            if (empty($row['path'])) {
                // Main category
                $categories[$row['uid']] = $row;
                $categories[$row['uid']]['subcategories'] = [];
            } else {
                // Subcategory: push into its parent's array
                $categories[$row['path']]['subcategories'][] = $row;
            }
        }
             
        return array_values($categories);
    }

    public function getCategoryData()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('category c');
        $builder->select(
            'c.id, c.uid, c.title, c.path, c.image, c.status, c.created_at, c.updated_at,
            cp.title AS path_name'
        );
        $builder->join('category cp', 'cp.uid = c.path', 'left');
        $builder->where('c.status !=', DELETED_STATUS);
        $builder->orderBy('c.created_at', 'ASC');

        $rows = $builder->get()->getResultArray();

        $categories = [];

        /** ----- First pass: create all categories ----- */
        foreach ($rows as $row) {
            $row['subcategories'] = [];
            $categories[$row['uid']] = $row;
        }

        /** ----- Second pass: attach subcategories to parents ----- */
        foreach ($categories as $uid => $category) {
            if (!empty($category['path']) && isset($categories[$category['path']])) {
                $categories[$category['path']]['subcategories'][] = $category;
                unset($categories[$uid]); // remove from root level
            }
        }

        return array_values($categories);
    }

    /** Get Category Details */

    /** Get Product Details */
    //     public function getProductsDetails()
    //     {
    //         $db = \Config\Database::connect();
    //         $builder = $db->table('product p');
    //         $builder->select('
    //             p.*, 
    //             v.name AS vendor_name, 
    //             v.email AS vendor_email, 
    //             v.mobile AS vendor_mobile,
    //             v.company as company,
    //             pi.image as image,
    //             c.title AS category_name
    //         ');
    //         $builder->join('vendor v', 'v.uid = p.vendor_id', 'left');
    //         $builder->join('category c', 'c.uid = p.category_id', 'left');
    //         // $builder->join('product_image pi','pi.product_id = p.uid AND pi.main_image = 1','left');
    //         // $builder->join('product_image pi','pi.product_id = p.uid AND pi.main_image = 1 AND pi.status = "active"','left');
    //         $builder->join(
    //     '(SELECT pi1.*
    //       FROM product_image pi1
    //       INNER JOIN (
    //           SELECT 
    //               product_id,
    //               MAX(created_at) AS latest_created
    //           FROM product_image
    //           WHERE status = "active"
    //           GROUP BY product_id
    //       ) pi2
    //       ON pi1.product_id = pi2.product_id
    //      AND pi1.created_at = pi2.latest_created
    //       WHERE pi1.main_image = 1
    //          OR pi1.main_image = 0
    //       ORDER BY 
    //           pi1.main_image DESC,
    //           pi1.status = "active" DESC
    //     ) pi',
    //     'pi.product_id = p.uid',
    //     'left',
    //     false
    // );


    //         $builder->orderBy('p.id', 'DESC');
    //         $builder->where('p.status !=', DELETED_STATUS);

    //         $result = $builder->get()->getResultArray();
    //         return $result;
    //     }



    public function getProductsDetails()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product p');

        $builder->select('
        p.*,
        v.name AS vendor_name,
        v.email AS vendor_email,
        v.mobile AS vendor_mobile,
        v.company AS company,
        pi.image AS image,
        c.title AS category_name
    ');

        $builder->join('vendor v', 'v.uid = p.vendor_id', 'left');
        $builder->join('category c', 'c.uid = p.category_id', 'left');
        $builder->join(
            '(SELECT pi1.*
          FROM product_image pi1
          INNER JOIN (
              SELECT product_id, MAX(created_at) AS latest_created
              FROM product_image
              WHERE status = "active"
              GROUP BY product_id
          ) pi2
          ON pi1.product_id = pi2.product_id
         AND pi1.created_at = pi2.latest_created
         AND pi1.status = "active"
        ) pi',
            'pi.product_id = p.uid',
            'left',
            false
        );
        $builder->where('p.status !=', DELETED_STATUS);
        $builder->groupBy('p.uid');
        $builder->orderBy('p.id', 'DESC');
        return $builder->get()->getResultArray();
    }

    /** Get Product Details */

    public function getProductsDetailsByProductId($productId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product p');
        $builder->select('
            p.*, 
            v.name AS vendor_name, 
            v.company as company,
            c.title AS category_name
        ');
        $builder->join('vendor v', 'v.uid = p.vendor_id', 'left');
        $builder->join('category c', 'c.uid = p.category_id', 'left');
        $builder->where('p.status !=', DELETED_STATUS);
        $builder->where('p.uid', $productId);

        $result = $builder->get()->getRowArray();
        return $result;
    }

    public function getRequestsDetails($vendorId = null, $customer = null, $product = null, $date = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('request r');
        $builder->select('
            r.*, 
            c.name AS customer_name, 
            c.mobile AS customer_mobile, 
            c.email AS customer_email, 
            p.name AS product_name,
            v.name AS vendor_name
        ');
        $builder->join('customer c', 'c.uid = r.customer_id', 'left');
        $builder->join('product p', 'p.uid = r.product_id', 'left');
        $builder->join('vendor v', 'v.uid = r.vendor_id', 'left');

        $builder->where('r.status', ACTIVE_STATUS);
        if ($vendorId != null) {
            $builder->where('r.vendor_id', $vendorId);
        }
        if ($customer != null) {
            $builder->where('r.customer_id', $customer);
        }
        if ($product != null) {
            $builder->where('r.product_id', $product);
        }
        if ($date != null) {
            $builder->where('DATE(r.created_at)', $date);
        }
        $builder->orderBy('r.created_at', 'DESC');
        $result = $builder->get()->getResultArray();
        return $result;
    }

    public function getCustomerReview($customerId = null, $productId = null)
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
        $builder->orderBy('pr.id', 'DESC');
        $builder->where('pr.status', ACTIVE_STATUS);

        if ($customerId != null) {
            $builder->where('pr.customer_id', $customerId);
        }
        if ($productId != null) {
            $builder->where('pr.product_id', $productId);
        }

        $result = $builder->get()->getResultArray();
        return $result;
    }
}
