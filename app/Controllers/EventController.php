<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class EventController extends BaseController
{
    public function index()
    {
        // Base directory where folders will be created
        $baseDir = ROOTPATH . 'public/uploads/';

        // Fetch existing folders for selection
        $existingFolders = array_filter(glob($baseDir . '*'), 'is_dir');

        // Pass existing folders to the view
        $data['existingFolders'] = array_map('basename', $existingFolders);

        return view('Event', $data);
    }

    public function manageFolder()
    {
        // Base directory where folders will be created
        $baseDir = ROOTPATH . 'public/uploads/';

        if ($this->request->getMethod() == 'post') {
            // Create a new folder
            $newFolderName = $this->request->getPost('new_folder');
            if ($newFolderName) {
                $newFolderPath = $baseDir . $newFolderName;

                if (!file_exists($newFolderPath)) {
                    mkdir($newFolderPath, 0777, true);
                    return redirect()->back()->with('success', "Folder '$newFolderName' created successfully.");
                } else {
                    return redirect()->back()->with('error', "Folder '$newFolderName' already exists.");
                }
            }

            // Select an existing folder
            $selectedFolder = $this->request->getPost('existing_folder');
            if ($selectedFolder) {
                return redirect()->back()->with('success', "You selected the folder: $selectedFolder");
            }
        }

        return redirect()->back();
    }
}
