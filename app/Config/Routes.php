<?php
 use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {

  $routes->get('/', 'UserController::index');

  //User
  $routes->get('/register', 'UserController::register');
  $routes->post('user/store', 'UserController::store');
  $routes->get('/users', 'UserController::listUsers');
  $routes->get('users/edit/(:num)', 'UserController::edit/$1');
  $routes->post('users/edit/(:num)', 'UserController::edit/$1');
    
    //FileController
      $routes->get('/upload', 'FileController::index');
      $routes->post('/upload', 'FileController::upload');




      $routes->get('/login', 'UserController::login');
      $routes->post('/user/login', 'UserController::login');

      // $routes->get('/login', 'UserController::login');
      // $routes->post('/login', 'UserController::login');

 

      $routes->get('/logout', 'UserController::logout');

      $routes->get('/admin/dashboard', 'AccessController::admin');
      $routes->get('admin', 'FileController::index');
      $routes->get('/photographer/dashboard', 'AccessController::photographer');

      //Manager
      $routes->get('/manager/dashboard', 'AccessController::manager');
      $routes->post('approve/(:num)', 'FileController::approve/$1');



      $routes->get('/fbteam/dashboard', 'AccessController::fbteam');

      $routes->get('/approved-uploads', 'AccessController::viewApprovedUploads');
      $routes->post('update_approval_status', 'FileController::updateApprovalStatus');


      $routes->get('delete/(:num)', 'FileController::delete/$1');


 });