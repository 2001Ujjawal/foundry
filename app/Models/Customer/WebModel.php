<?php

namespace App\Models\Customer;

use CodeIgniter\Model;

class WebModel extends Model
{

    public function getCustomerReview()
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
        $builder->orderBy('pr.rating', 'DESC');
        $builder->orderBy('pr.created_at', 'DESC');
        $builder->where('pr.status', ACTIVE_STATUS);
        $result = $builder->get()->getResultArray();
        return $result;
    }

    public function getCustomerReviewByProductId($productId)
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
        $builder->where('pr.product_id', $productId);
        $builder->where('pr.status', ACTIVE_STATUS);
        $result = $builder->get()->getResultArray();
        $result = array_map(function ($row) {
            $row['created_at'] = $this->timeAgo($row['created_at']);
            return $row;
        }, $result);
        return $result;
    }




    function timeAgo($datetime)
    {
        $time = strtotime($datetime); // convert date string to timestamp
        $diff = time() - $time; // difference in seconds

        if ($diff < 60) {
            return 'Just now';
        } elseif ($diff < 3600) {
            return floor($diff / 60) . ' minute' . (floor($diff / 60) > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 86400) {
            return floor($diff / 3600) . ' hour' . (floor($diff / 3600) > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 604800) {
            return floor($diff / 86400) . ' day' . (floor($diff / 86400) > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 2628000) { // about 1 month
            return floor($diff / 604800) . ' week' . (floor($diff / 604800) > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 31536000) { // about 1 year
            return floor($diff / 2628000) . ' month' . (floor($diff / 2628000) > 1 ? 's' : '') . ' ago';
        } else {
            return floor($diff / 31536000) . ' year' . (floor($diff / 31536000) > 1 ? 's' : '') . ' ago';
        }
    }


    public function getProductList($categoryUid = [], $priceFrom = 0, $priceTo = 50000)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->select('*');
        $builder->where('status', ACTIVE_STATUS);
        if (!empty($categoryUid) && is_array($categoryUid)) {
            $builder->whereIn('category_id', $categoryUid);
        }
        if (is_numeric($priceFrom) && is_numeric($priceTo)) {
            $builder->where('price >=', $priceFrom);
            $builder->where('price <=', $priceTo);
        }
        $result = $builder->get()->getResultArray();
        return $result;
    }

    public function getProductDetailsByProductId_old($productId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product p');
        $builder->select('
            p.*, 
            v.name AS vendor_name, 
            v.mobile AS vendor_mobile, 
            v.email AS vendor_email, 
            cat.title AS category_name
        ');
        $builder->join('vendor v', 'v.uid = p.vendor_id', 'left');
        $builder->join('category cat', 'cat.uid = p.category_id', 'left');
        $builder->where('p.uid', $productId);
        $product = $builder->get()->getRowArray();

        $imageBuilder = $db->table('product_image');
        $imageBuilder->select('*');
        $imageBuilder->where('product_id', $productId);
        $images = $imageBuilder->get()->getResultArray();

        $product['images'] = $images;

        return $product;
    }

    public function getAllProductDetails()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product p');

        $builder->select('
                p.*, 
                v.name AS vendor_name,
                v.is_verify AS is_vendor_verify,
                v.company AS vendor_company,
                (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid) AS total_customer_review,
                (SELECT SUM(r.rating) FROM product_rating r WHERE r.product_id = p.uid) AS total_rating,
                (
                    CASE 
                        WHEN (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid) > 0 
                        THEN ROUND((SELECT SUM(r.rating) FROM product_rating r WHERE r.product_id = p.uid) / (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid), 1)
                        ELSE 0
                    END
                ) AS total_rating_percent,
            (SELECT pi.image 
                FROM product_image pi 
                WHERE pi.product_id = p.uid 
                
                AND pi.main_image = 1 
                LIMIT 1
                ) AS main_image
            ');

        $builder->join('vendor v', 'v.uid = p.vendor_id', 'inner');
        $builder->where('p.status', ACTIVE_STATUS);
        $builder->where('v.status', ACTIVE_STATUS);
        $builder->where('p.is_verify', 1);
        $builder->where('p.is_admin_allow', true);
        $builder
            ->orderBy('(p.sort_order = 0)', 'ASC', false)           // false => don't escape; non-zeros first
            ->orderBy('p.sort_order', 'ASC');                       // then ascending within non-zeros
        $builder->limit(20);
        $result = $builder->get()->getResultArray();

        return $result;
    }
    public function getFilteredProductDetails(
        $categoryUid = [],
        $priceFrom = 0,
        $priceTo = 100000,
        $vendorCountries = [],
        $vendorType = null
    ) {
        $db = \Config\Database::connect();
        $builder = $db->table('product p');

        $builder->select("
                p.*, 
                v.name AS vendor_name,
                v.is_verify AS is_vendor_verify,
                v.company AS vendor_company,
                v.country AS vendor_country, 
                (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid) AS total_customer_review,
                (SELECT SUM(r.rating) FROM product_rating r WHERE r.product_id = p.uid) AS total_rating,
                (
                    CASE 
                        WHEN (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid) > 0 
                        THEN ROUND(
                            (SELECT SUM(r.rating) FROM product_rating r WHERE r.product_id = p.uid) / 
                            (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid), 1
                        )
                        ELSE 0
                    END
                ) AS total_rating_percent,
                (
                    SELECT pi.image 
                    FROM product_image pi 
                    WHERE pi.product_id = p.uid 
                    AND pi.main_image = 1
                    AND pi.status = 'active'
                    LIMIT 1
                ) AS main_image
            ");

        $builder->join('vendor v', 'v.uid = p.vendor_id', 'inner');
        $builder->where('p.status', ACTIVE_STATUS);
        $builder->where('v.status', ACTIVE_STATUS);
        $builder->where('p.is_admin_allow', true);

        // Category filter
        if (!empty($categoryUid) && is_array($categoryUid)) {
            $builder->groupStart()
                ->whereIn('p.category_id', $categoryUid)
                ->orWhereIn('p.subcategory_id', $categoryUid)
                ->groupEnd();
        }

        // Country filter
        if (!empty($vendorCountries) && is_array($vendorCountries)) {
            $builder->whereIn('v.country', $vendorCountries);
        }

        // Vendor type filter (0 = not verified, 1 = verified)
        if ($vendorType !== null && $vendorType !== '') {
            $builder->where('v.is_verify', (int)$vendorType);
        }

        // Price range filter
        // if (is_numeric($priceFrom) && is_numeric($priceTo)) {
        //     $builder->where('p.price >=', $priceFrom);
        //     $builder->where('p.price <=', $priceTo);
        // }

        // Order
        $builder->orderBy('p.is_verify', 'DESC');
        $builder->orderBy('p.uid', 'DESC');

        return $builder->get()->getResultArray();
    }


    // public function getFilteredProductDetails($categoryUid = [], $priceFrom = 0, $priceTo = 100000, $vendorCountries, $vendorType)
    // {
    //     $db = \Config\Database::connect();
    //     $builder = $db->table('product p');
    //     $vendor_type = (bool)$vendorType;
    //     $builder->select('
    //                     p.*, 
    //                     v.name AS vendor_name,
    //                     v.is_verify AS is_vendor_verify,
    //                     v.company AS vendor_company,
    //                     v.country AS vendor_country, 
    //                     (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid) AS total_customer_review,
    //                     (SELECT SUM(r.rating) FROM product_rating r WHERE r.product_id = p.uid) AS total_rating,
    //                     (
    //                         CASE 
    //                             WHEN (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid) > 0 
    //                             THEN ROUND(
    //                                 (SELECT SUM(r.rating) FROM product_rating r WHERE r.product_id = p.uid) / 
    //                                 (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid), 1)
    //                             ELSE 0
    //                         END
    //                     ) AS total_rating_percent ,
    //                      (SELECT pi.image 
    //                         FROM product_image pi 
    //                         WHERE pi.product_id = p.uid 

    //                         AND pi.main_image = 1 
    //                         LIMIT 1
    //                         ) AS main_image
    //                 ');
    //     $builder->join('vendor v', 'v.uid = p.vendor_id', 'inner');
    //     // $builder->join('vendor v', 'v.uid = p.vendor_id');
    //     $builder->where('p.status', ACTIVE_STATUS);


    //     // Category filter
    //     if (!empty($categoryUid) && is_array($categoryUid)) {
    //         $builder->groupStart()
    //             ->whereIn('p.category_id', $categoryUid)
    //             ->orWhereIn('p.subcategory_id', $categoryUid)
    //             ->groupEnd();
    //     }
    //     if (!empty($vendorCountries) && is_array($vendorCountries)) {
    //         $builder->whereIn('v.country', $vendorCountries);
    //     }
    //     if (!empty($vendorType && is_array($vendorCountries))) {
    //         $builder->where('v.is_verify', $vendor_type);
    //     }
    //     // Price range filter
    //     // if (is_numeric($priceFrom) && is_numeric($priceTo)) {
    //     //     $builder->where('p.price >=', $priceFrom);
    //     //     $builder->where('p.price <=', $priceTo);
    //     // }
    //     $builder->where('v.status', ACTIVE_STATUS);
    //     $builder->orderBy('p.is_verify', 'DESC');

    //     $builder->where('p.status', ACTIVE_STATUS);
    //     $builder->where('v.status', ACTIVE_STATUS);
    //     // $builder->where('p.is_verify', 1);
    //     $builder->where('p.is_admin_allow', true);
    //     $builder->orderBy('p.is_verify', 'DESC');
    //     $builder->orderBy('p.uid', 'DESC');

    //     $result = $builder->get()->getResultArray();
    //     return $result;
    // }

    public function getProductDetailsByProductId($productId)
    {
        $db = \Config\Database::connect();

        // Product + Vendor + Category + Ratings
        $builder = $db->table('product p');
        $builder->select('
            p.*, 
            v.name AS vendor_name, 
            v.mobile AS vendor_mobile, 
            v.email AS vendor_email, 
             v.image AS vendor_image, 
             v.is_verify AS vendor_is_verify , 
             v.country AS vendor_country,
             v.states AS vendor_states,
             v.city AS vendor_city,
                v.website AS vendor_website,
            cat.title AS category_name,
            (
                SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid
            ) AS total_customer_review,
            (
                SELECT SUM(r.rating) FROM product_rating r WHERE r.product_id = p.uid
            ) AS total_rating,
            (
                CASE 
                    WHEN (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid) > 0 
                    THEN ROUND(
                        (SELECT SUM(r.rating) FROM product_rating r WHERE r.product_id = p.uid) /
                        (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid), 1
                    )
                    ELSE 0
                END
            ) AS total_rating_percent
        ');
        $builder->join('vendor v', 'v.uid = p.vendor_id', 'left');
        $builder->join('category cat', 'cat.uid = p.category_id', 'left');
        $builder->where('p.uid', $productId);
        $product = $builder->get()->getRowArray();

        // Get product images
        $imageBuilder = $db->table('product_image');
        $imageBuilder->select('*');
        $imageBuilder->where('product_id', $productId);
        $imageBuilder->where('status', ACTIVE_STATUS);
        $images = $imageBuilder->get()->getResultArray();

        // Append images to product
        $product['images'] = $images;

        $product['main_image'] = $db->table('product_image')->where('product_id', $productId)
            ->orderBy('created_at', 'DESC')
            ->where('main_image', 1)

            ->where('status', ACTIVE_STATUS)

            ->get()
            ->getRow();

        return $product;
    }




    public function getAllMightBeProductDetails($categoryUid)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product p');

        $builder->select('
            p.*, 
            v.name AS vendor_name,
            v.is_verify AS is_vendor_verify,
            v.company AS vendor_company,
            (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid) AS total_customer_review,
            (SELECT SUM(r.rating) FROM product_rating r WHERE r.product_id = p.uid) AS total_rating,
            (
                CASE 
                    WHEN (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid) > 0 
                    THEN ROUND((SELECT SUM(r.rating) FROM product_rating r WHERE r.product_id = p.uid) / (SELECT COUNT(*) FROM product_rating r WHERE r.product_id = p.uid), 1)
                    ELSE 0
                END
            ) AS total_rating_percent ,
            (SELECT pi.image 
                FROM product_image pi 
                WHERE pi.product_id = p.uid 
                
                AND pi.main_image = 1 
                LIMIT 1
            ) AS main_image
        ');
        $builder->join('vendor v', 'v.uid = p.vendor_id', 'inner');
        $builder->where('p.status', ACTIVE_STATUS);
        $builder->orderBy('p.is_verify', 'DESC');

        $builder->orderBy('p.uid', 'DESC');
        $builder->where('p.category_id', $categoryUid);
        $result = $builder->get()->getResultArray();

        return $result;
    }


    public function getVendorCountryList()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('vendor v');

        $builder->select('DISTINCT(v.country)');  // distinct country
        $builder->join('product p', 'p.vendor_id = v.uid', 'inner'); // only vendors having products
        $builder->where('v.status', ACTIVE_STATUS);   // vendor active
        // $builder->where('v.is_verify', 1);            // only verified vendors
        $builder->where('p.status', ACTIVE_STATUS);   // product active
        $builder->where('p.is_admin_allow', 1);       // product approved (if you use that)

        $result = $builder->get()->getResultArray();
        return $result;
    }


    public function getStatics()
    {
        return [
            'total_vendors' => $this->getTotalVendors(),
            'total_customers' => $this->getTotalCustomers(),
            'total_products' => $this->getTotalProducts(),
            'total_country' => $this->getVendorCountryCountry(),
            'total_request' => $this->getCustomerTotalRequest(),
        ];
    }

    public function getVendorCountryCountry()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('vendor'); // fixed typo from 'venodr'
        $builder->select('country');
        $builder->distinct();
        $builder->where('status', ACTIVE_STATUS);
        return $builder->countAllResults();
    }


    public function getTotalVendors()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('vendor');
        $builder->where('status', ACTIVE_STATUS);
        return $builder->countAllResults();
    }
    public function getTotalCustomers()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('customer');

        $builder->where('status', ACTIVE_STATUS);
        return $builder->countAllResults();
    }
    public function getTotalProducts()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->where('status', ACTIVE_STATUS);
        return $builder->countAllResults();
    }

    public function getCustomerTotalRequest()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('request');
        $builder->where('status', ACTIVE_STATUS);
        return $builder->countAllResults();
    }

    public function getProductSeoByProductUid($productUid)
    {
        return $this->db->table('product_seo')
            ->select('meta_title, meta_description, meta_keywords, meta_tags')
            ->where('product_uid', $productUid)
            ->where('status', 'active')
            ->get()
            ->getRowArray();
    }

}
