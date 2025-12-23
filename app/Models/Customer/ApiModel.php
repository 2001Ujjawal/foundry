<?php

namespace App\Models\Customer;

use CodeIgniter\Model;

class ApiModel extends Model
{

    public function checkCustomerLogin($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table(CUSTOMER_TABLE);
        $loginDetails = $builder
            ->select('*')
            ->where('email', $email)
            ->where('status !=', DELETED_STATUS)
            ->get()
            ->getRowArray();
        return $loginDetails;
    }
}
