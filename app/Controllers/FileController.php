<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UploadModel;

class FileController extends BaseController
{
    public function index()
    {
        $uploadModel = new UploadModel();
        $data['files'] = $uploadModel->findAll(); // Fetch all files from the database
        return view('UploadForm', $data); // Pass the file data to the view
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
                    $file->move(WRITEPATH . 'uploads', $newName); // Move the file to the uploads directory

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

        $data['files'] = $uploadModel->findAll(); // Ensure to pass the file data to the view if needed
        return view('UploadForm', $data); // Reload the upload form view
    }
}
