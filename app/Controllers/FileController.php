<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UploadModel;
use App\Models\UserModel;

class FileController extends BaseController
{
    public function index()
    {
        
        return view('UploadForm');
    }

    public function upload()
{
    helper(['form', 'url']); // Load the form and URL helpers

    $uploadModel = new UploadModel();
    $userID = session()->get('user_id'); // Retrieve the user ID from the session

    if ($this->request->getMethod() == 'post') {
        $files = $this->request->getFiles(); // Get all uploaded files
        $description = $this->request->getPost('description'); // Get the description from the form

        foreach ($files['files'] as $file) {
            if ($file->isValid() && !$file->hasMoved()) { // Check if the file is valid and hasn't been moved
                $newName = $file->getRandomName(); // Generate a random file name
                $file->move(ROOTPATH . 'public/uploads', $newName); // Move the file to the uploads directory in the project

                // Prepare the data to be saved in the database
                $data = [
                    'filename'    => $newName,
                    'description' => $description,
                    'user_id'     => $userID, // Save the user ID
                    'created_at'  => date('Y-m-d H:i:s'), // Save the current timestamp
                ];
                $uploadModel->saveFileData($data); // Save the file data to the database
            }
        }

        return redirect()->to('/upload'); // Redirect to a success page or any other page
    }

    $data['file'] = $uploadModel->findAll(); // Ensure to pass the file data to the view if needed
    return view('UploadForm', $data); // Reload the upload form view
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
            return $this->response->setJSON(['success' => false], ResponseInterface::HTTP_BAD_REQUEST);
        }
    }

    public function delete($id)
    {
        $uploadModel = new UploadModel();
        $file = $uploadModel->find($id);

        if ($file) {
            // Delete the file from the server
            $filePath = WRITEPATH . 'uploads/' . $file['filename'];
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file from the server
            }

            // Delete the file record from the database
            $uploadModel->delete($id);

            // Redirect to the admin dashboard with a success message
            return redirect()->to('/admin/dashboard')->with('success', 'File deleted successfully');
        } else {
            // If file not found, show an error
            return redirect()->to('/admin/dashboard')->with('error', 'File not found');
        }
    }


}
