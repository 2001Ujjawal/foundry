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
        'updated_at'
    ];

    protected $useTimestamps = false;
}

class ProductSeoModel extends Model
{
    protected $table            = 'product_seo';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields = [
        'uid',
        'product_uid',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'tags',
        'status'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';
    public function getByProductUid(string $productUid): ?array
    {
        return $this->where('product_uid', $productUid)
            ->where('status !=', 'deleted')
            ->first();
    }
    public function softDeleteByProductUid(string $productUid): bool
    {
        return (bool) $this->where('product_uid', $productUid)
            ->set(['status' => 'deleted'])
            ->update();
    }
}
