<?php

namespace App\Models\Vendors;

use CodeIgniter\Model;

class ApiModel extends Model
{

    public function checkAdminLogin($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table(VENDOR_TABLE);
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

    public function checkForgotOtp($otpUid, $user_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table(OTP_LIST_TABLE);
        $otpDetails = $builder
            ->select('*')
            ->where('uid', $otpUid)
            ->where('user_id', $user_id)
            ->where('type', OTP_LIST_FORGOT_PASSWORD)
            ->get()
            ->getRowArray();
        return $otpDetails;
    }
}
