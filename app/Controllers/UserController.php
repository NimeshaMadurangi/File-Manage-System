<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $session;

    public function __construct()
    {
        // Initialize session
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('Splash');
    }

    public function login()
    {
        // Check if the request method is POST
        if ($this->request->getMethod() === 'post') {
            $userModel = new UserModel();

            // Get the input values
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Validate input
            $validation = \Config\Services::validation();
            $validation->setRules([
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]'
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->with('errors', $validation->getErrors())->withInput();
            }

            // Check if the user exists
            $user = $userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                // Set session data
                $this->session->set([
                    'user_id' => $user['id'],
                    'user_role' => $user['role'],
                    'isLoggedIn' => true,
                ]);

                // Redirect based on role
                switch ($user['role']) {
                    case 'admin':
                        return redirect()->to('/admin/dashboard');
                    case 'photographer':
                        return redirect()->to('/photographer/dashboard');
                    case 'manager':
                        return redirect()->to('/manager/dashboard');
                    case 'fbteam':
                        return redirect()->to('/fbteam/dashboard');
                    default:
                        return redirect()->to('/login')->with('error', 'Invalid role');
                }
            } else {
                return redirect()->to('/login')->with('error', 'Invalid login credentials');
            }
        }

        // Render the login view if not a POST request
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function store()
    {
        log_message('info', 'Store method called');

        $validationRules = [
            'username' => 'required|string|max_length[255]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirmPassword' => 'required|matches[password]',
            'role'     => 'required|in_list[admin,manager,photographer,fbteam]',
        ];

        if (!$this->validate($validationRules)) {
            $errors = $this->validator->getErrors();
            log_message('error', 'Validation Errors: ' . json_encode($errors));
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash password
            'role'     => $this->request->getPost('role'),
        ];

        if ($userModel->save($data)) {
            return redirect()->to('/login')->with('success', 'Registration successful. Please log in.');
        } else {
            $errors = $userModel->errors();
            log_message('error', 'Failed to save user data: ' . json_encode($errors));
            return redirect()->back()->with('error', 'Failed to register user. Please try again.');
        }
    }

    public function listUsers()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll(); // Fetch all users

        // Pass the list of users to the view
        return view('UserList', ['users' => $users]);
    }

    public function edit($id = null)
    {
        $userModel = new UserModel();

        // Fetch user data from the database
        $user = $userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found');
        }

        if ($this->request->getMethod() === 'post') {
            // Validate form input
            $validation = \Config\Services::validation();
            $validation->setRules([
                'username' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|valid_email',
                'role' => 'required'
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                // If validation fails, load the view with validation errors
                return view('edit_user', [
                    'user' => $user,
                    'validation' => $validation
                ]);
            }

            // Update user data
            $userModel->update($id, [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'role' => $this->request->getPost('role')
            ]);

            return redirect()->to('/users');
        }

        // Load the view with user data
        return view('Edit', [
            'user' => $user
        ]);
    }

    public function logout()
    {
        // Destroy the session and redirect to login
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
