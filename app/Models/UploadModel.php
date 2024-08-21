<?php

namespace App\Models;

use CodeIgniter\Model;

class UploadModel extends Model
{
    protected $table = 'uploads';
    protected $primaryKey = 'id';
    protected $allowedFields = ['filename', 'description', 'user_id', 'created_at'];

    // Method to save the file data
    public function saveFileData($data)
    {
        return $this->insert($data);
    }
}
