<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UploadModel;
use CodeIgniter\Files\File;

class FileController extends BaseController
{
    public function index()
    {
        $uploadModel = new UploadModel();
        $data['existingFolders'] = $this->getExistingFolders();
        return view('UploadForm', $data);
    }

    public function upload()
    {
        helper(['form', 'url']);

        $uploadModel = new UploadModel();
        $userID = session()->get('user_id');

        if ($this->request->getMethod() == 'post') {
            $files = $this->request->getFiles();
            $description = $this->request->getPost('description');
            $newFolderName = $this->request->getPost('new_folder');
            $selectedFolder = $this->request->getPost('existing_folder');

           
            $targetFolder = $selectedFolder ? $selectedFolder : 'uploads';

            if ($newFolderName) {
               
                $targetFolder = 'uploads/' . $newFolderName;
                if (!is_dir($targetFolder)) {
                    mkdir($targetFolder, 0777, true);
                }
            }

            foreach ($files['files'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/' . $targetFolder, $newName);

                   
                    $data = [
                        'filename'     => $newName,
                        'description'  => $description,
                        'user_id'      => $userID,
                        'folder'       => $targetFolder,
                        'created_at'   => date('Y-m-d H:i:s'),
                    ];
                    $uploadModel->saveFileData($data);
                }
            }

            return redirect()->to('/upload')->with('success', 'Files uploaded successfully');
        }

        $data['existingFolders'] = $this->getExistingFolders();
        return view('UploadForm', $data);
    }

    private function getExistingFolders()
    {

        $folders = [];
        $dir = ROOTPATH . 'public/uploads';

        if (is_dir($dir)) {
            $items = scandir($dir);
            foreach ($items as $item) {
                if ($item != '.' && $item != '..' && is_dir($dir . '/' . $item)) {
                    $folders[] = $item;
                }
            }
        }

        return $folders;
    }

    public function updateApprovalStatus()
    {
        $json = $this->request->getJSON();
        $id = $json->id;
        $approved = $json->approved ? 1 : 0;

        $uploadModel = new UploadModel();
        $data = [
            'approve' => $approved
        ];

        if ($uploadModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false], 400);
        }
    }

    public function delete($id)
    {
        $uploadModel = new UploadModel();
        $file = $uploadModel->find($id);

        if ($file) {
            
            $filePath = ROOTPATH . 'public/' . $file['folder'] . '/' . $file['filename'];
            if (file_exists($filePath)) {
                unlink($filePath); 
            }

          
            $uploadModel->delete($id);

            
            return redirect()->to('/admin/dashboard')->with('success', 'File deleted successfully');
        } else {
           
            return redirect()->to('/admin/dashboard')->with('error', 'File not found');
        }
    }
}
