<?php

namespace App\Models\Vendors;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'uid',
        'vendor_id',
        'name',
        'slug',
        'category_id',
        'subcategory_id',
        'description',
        'image',
        'status',
        'is_admin_allow',
        'created_at',
        'updated_at'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = false;

    protected $beforeInsert = ['makeSlug'];
    protected $beforeUpdate = ['makeSlug'];

    protected function makeSlug(array $data)
    {
        if (!isset($data['data']['name'])) {
            return $data;
        }

        $baseSlug = strtolower(url_title($data['data']['name'], '-', true));
        $slug = $baseSlug;

        $i = 1;
        while ($this->where('slug', $slug)->first()) {
            $slug = $baseSlug . '-' . $i++;
        }

        $data['data']['slug'] = $slug;

        return $data;
    }
}


class ProductImageModel extends Model
{
    protected $table = 'product_image';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'uid',
        'product_id',
        'image',
        'main_image',
        'status',
        'created_at',
        'created_by',
        'update_at'
    ];

    protected $useTimestamps = false;
}
