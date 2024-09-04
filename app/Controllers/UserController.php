<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('splash');
    }

    public function login()
{
    // Check if user is already logged in and redirect to the appropriate dashboard
    if ($this->session->get('isLoggedIn')) {
        return $this->redirectBasedOnRole($this->session->get('role'));
    }

    return view('login'); // Make sure this view file exists
}


    public function logout()
    {
        // Destroy the session and redirect to login
        $this->session->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        return view('register');
    }

    public function store()
    {
        // Define validation rules
        $validationRules = [
            'username' => 'required|min_length[3]|max_length[20]',
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]|matches[confirmPassword]',
            'confirmPassword' => 'required'
        ];

        // Validate the input data
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Check if user already exists
        $userModel = new UserModel();
        if ($userModel->where('email', $this->request->getPost('email'))->first()) {
            return redirect()->back()->withInput()->with('error', 'Email already in use.');
        }

        // Get input data
        $userData = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'     => $this->request->getPost('role')
        ];

        // Save user data to the database
        if ($userModel->save($userData)) {
            return redirect()->to('/users')->with('success', 'User registered successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to register user.')->withInput();
        }
    }
}
