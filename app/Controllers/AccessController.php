<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UploadModel;

class AccessController extends BaseController
{
    public function admin()
    {
        $userModel = new UserModel();
        $uploadModel = new UploadModel();

        // Get the count of users
        $userCount = $userModel->countAllResults();

        $fileCount = $uploadModel->countAllResults();
        
        // Fetch all data from the uploads table
        $uploads = $uploadModel->findAll();

        // Pass both user count and uploads data to the view
        return view('AdminDashboard', [
            'userCount' => $userCount,
            'fileCount' => $fileCount,
            'uploads' => $uploads
        ]);
    }

    public function photographer()
    {
        return view('PhotographerDashboard');
    }

    public function manager()
    {
        $uploadModel = new UploadModel();
        $uploads = $uploadModel->findAll(); // Fetch all records

        return view('ManagerDashboard', ['uploads' => $uploads]);
    }

    public function fbteam()
    {
        return view('FBTeamDashboard');
    }

    public function viewApprovedUploads()
    {
        $uploadModel = new UploadModel();
        
        // Fetch only approved uploads where approve column is 1
        $approvedUploads = $uploadModel->where('approve', 1)->findAll();

        // Pass the approved uploads data to the view
        return view('Accept', ['uploads' => $approvedUploads]);
    }
}
