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

    $userCount = $userModel->countAllResults();

    $fileCount = $uploadModel->countAllResults();

    $folderCount = $uploadModel->countAllResults();

    $searchQuery = $this->request->getGet('search');

    if ($searchQuery) {
        $uploads = $uploadModel->search($searchQuery);
    } else {
        $uploads = $uploadModel->orderBy('created_at', 'DESC')->limit(10)->findAll();
    }

    $folders = $uploadModel->select('folder')->distinct()->findColumn('folder');

    return view('AdminDashboard', [
        'userCount' => $userCount,
        'fileCount' => $fileCount,
        'uploads' => $uploads,
        'searchQuery' => $searchQuery,
        'folders' => $folders,
    ]);
}


    public function photographer()
    {
        return view('PhotographerDashboard');
    }

    public function manager()
    {
        $uploadModel = new UploadModel();

        // Handle search query
        $searchQuery = $this->request->getGet('search');

        if ($searchQuery) {
            // Fetch uploads that match the search query
            $uploads = $uploadModel->search($searchQuery);
        } else {
            // Fetch all records
            $uploads = $uploadModel->findAll();
        }

        return view('ManagerDashboard', [
            'uploads' => $uploads,
            'searchQuery' => $searchQuery, // Pass search query to the view
        ]);
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
