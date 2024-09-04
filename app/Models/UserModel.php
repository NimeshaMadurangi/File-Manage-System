<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['username', 'email', 'password', 'role'];
    protected $returnType    = 'array'; // Ensure the return type is an array
    protected $useTimestamps = true;    // Automatically manage created_at and updated_at fields

    // Validation rules
    protected $validationRules = [
        'username' => 'required|string|max_length[255]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'role'     => 'required|in_list[admin,manager,photographer,fbteam]',
    ];

    // Hash password before inserting or updating
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    // Method to hash password
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }
        return $data;
    }
}
