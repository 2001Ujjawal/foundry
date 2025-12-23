<?php

namespace App\Models\Vendors;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'lead_payments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'uid',
        'request_id',
        'vendor_id',
        'gateway',
        'gateway_order_id',
        'gateway_payment_id',
        'amount',
        'currency',
        'status',
        'meta',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $returnType = 'array';

    public function createPayment(array $data)
    {
        $data['uid'] = $data['uid'] ?? bin2hex(random_bytes(8));
        $this->insert($data);
        return $this->getInsertID();
    }

    public function updateByUid(string $uid, array $data)
    {
        return $this->where('uid', $uid)->set($data)->update();
    }

    public function findByRequestId($requestId)
    {
        return $this->where('request_id', $requestId)->orderBy('id', 'DESC')->first();
    }

    public function findByUid(string $uid)
    {
        return $this->where('uid', $uid)->first();
    }
}
