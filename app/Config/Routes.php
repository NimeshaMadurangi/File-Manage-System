<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    // Home
    $routes->get('/', 'UserController::index');

    // User-related routes
    $routes->get('/register', 'UserController::register');
    $routes->post('/user/store', 'UserController::store');
    $routes->get('/users', 'UserController::listUsers');
    $routes->get('/users/edit/(:num)', 'UserController::edit/$1');
    $routes->post('/users/edit/(:num)', 'UserController::edit/$1');

    // File-related routes
    $routes->get('/upload', 'FileController::index');
    $routes->post('/upload', 'FileController::upload');
    $routes->post('/update_approval_status', 'FileController::updateApprovalStatus');
    $routes->get('/delete/(:num)', 'FileController::delete/$1');
    
    // Login/Logout routes
    // Login/Logout routes
$routes->get('/login', 'UserController::login');    // Display login form
$routes->post('/login', 'UserController::login');   // Process login form submission
$routes->get('/logout', 'UserController::logout');  // Handle logout


    // Admin Dashboard routes
    $routes->get('/admin/dashboard', 'AccessController::admin');
    $routes->get('/admin', 'FileController::index'); // This might be redundant if /upload already points to FileController::index

    // Photographer Dashboard routes
    $routes->get('/photographer/dashboard', 'AccessController::photographer');

    // Manager Dashboard routes
    $routes->get('/manager/dashboard', 'AccessController::manager');
    $routes->post('/approve/(:num)', 'FileController::approve/$1'); // Ensure there's an approve method in FileController

    // FB Team Dashboard routes
    $routes->get('/fbteam/dashboard', 'AccessController::fbteam');

    // Approved Uploads Gallery
    $routes->get('/approved-uploads', 'AccessController::viewApprovedUploads');
});
