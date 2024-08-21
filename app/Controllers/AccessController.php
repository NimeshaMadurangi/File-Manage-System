<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel; // Import the UserModel
use CodeIgniter\HTTP\ResponseInterface;

class AccessController extends BaseController
{
    public function admin()
    {
        $userModel = new UserModel();
        
        // Get the count of users
        $userCount = $userModel->countAllResults();

        // Pass the user count to the view
        return view('AdminDashboard', ['userCount' => $userCount]);

        $uploadModel = new UploadModel();

        // Fetch all data from the uploads table
        $data['uploads'] = $uploadModel->findAll();
    }

    public function photographer()
    {
        return view('PhotographerDashboard');
    }

    public function manager()
    {
        return view('ManagerDashboard');
    }

    public function fbteam()
    {
        return view('FBTeamDashboard');
    }
}
