<?php

namespace App\Models;

use CodeIgniter\Model;

class CommonModel extends Model
{

    public function insertData($tableName, $field)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($tableName);
        $builder->insert($field);
        return $db->insertID();
    }

    public function UpdateData($tableName, $whereArray, $updateData)
    {
        return $this->db->table($tableName)->where($whereArray)->set($updateData)->update();
    }

    public function getAllData($tableName, $whereArray, $selectFields = NULL, $orderBy = NULL)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($tableName);
        if (!is_null($selectFields) && $selectFields != "") {
            $builder->select($selectFields);
        }

        $builder->orderBy('created_at', 'desc');

        $builder->where($whereArray);

        return $query   = $builder->get()->getResultArray();
    }
    public function getSingleData($tableName, $whereArray, $selectFields = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($tableName);

        if (!is_null($selectFields) && $selectFields != "") {
            $builder->select($selectFields);
        }

        $builder->where($whereArray);

        return $builder->get()->getRowArray(); // Returns only 1 row
    }


    public function getCategory()
    {
        $db = \Config\Database::connect();
        $builder = $db->table(CATEGORY_TABLE);
        $builder->groupStart()
            ->where('path', '')     // Empty string
            ->orWhere('path IS NULL', null, false) // NULL value
            ->groupEnd();
        $builder->where(['status' => ACTIVE_STATUS]);
        return $builder->get()->getResultArray();
    }
    public function getVendors()
    {
        return $this->db->table('vendor')
            ->select('id, name, email')
            ->where('status', 1)
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getSingleDataNormalized(string $table, string $column, string $value)
    {
        if (!$this->db) {
            $this->db = \Config\Database::connect();
        }

        $builder = $this->db->table($table);

        $escapedValue = $this->db->escape(strtolower(trim($value)));

        $builder->where("
        LOWER(
            TRIM(
                REPLACE(
                    REPLACE(
                        REPLACE($column, '\n', ' '),
                    '\r', ' '),
                '\t', ' ')
            )
        ) = {$escapedValue}
    ", null, false);

        return $builder->get()->getRowArray();
    }
    public function getSingleDataLike(
        string $table,
        array $conditions,
        string $column,
        string $value
    ) {
        if (!$this->db) {
            $this->db = \Config\Database::connect();
        }

        $builder = $this->db->table($table);

        foreach ($conditions as $key => $val) {
            $builder->where($key, $val);
        }

        return $builder
            ->like("LOWER($column)", strtolower(trim($value)))
            ->get()
            ->getRowArray();
    }
}
