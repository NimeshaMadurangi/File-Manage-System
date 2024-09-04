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
    $routes->post('/users/edit/(:num)', 'UserController::edit/$1'); // Handles form submission for editing users

    // Login/Logout routes
    $routes->get('/login', 'UserController::login');
    $routes->post('/user/login', 'UserController::login'); 
    $routes->get('/logout', 'UserController::logout');

    $routes->get('/admin/dashboard', 'AccessController::admin');
    $routes->get('/photographer/dashboard', 'AccessController::photographer');
    $routes->get('/manager/dashboard', 'AccessController::manager');
    $routes->get('/fbteam/dashboard', 'AccessController::fbteam');

    // File-related routes
    $routes->get('/upload', 'FileController::index');
    $routes->post('/upload', 'FileController::upload');
    $routes->post('/update_approval_status', 'FileController::updateApprovalStatus');
    $routes->get('/delete/(:num)', 'FileController::delete/$1');
    $routes->post('/approve/(:num)', 'FileController::approve/$1'); // Ensure an approve method exists in FileController

    

    // Approved Uploads Gallery
    $routes->get('/approved-uploads', 'AccessController::viewApprovedUploads');

    // Event management routes
    $routes->get('/event', 'EventController::index');
    $routes->post('/event/manage-folder', 'EventController::manageFolder');
});
