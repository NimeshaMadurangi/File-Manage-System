<?php

namespace App\Models;

use CodeIgniter\Model;

class UploadModel extends Model
{
    protected $table = 'uploads';
    protected $primaryKey = 'id';
    protected $allowedFields = ['filename', 'description', 'user_id', 'approve', 'created_at'];

    public function saveFileData($data)
    {
        return $this->insert($data);
    }

    public function updateApproval($id, $status)
    {
        return $this->update($id, ['approve' => $status]);
    }

    public function search($query)
    {
        return $this->groupStart()
                    ->like('filename', $query)
                    ->orLike('description', $query)
                    ->groupEnd()
                    ->findAll();
    }
}
