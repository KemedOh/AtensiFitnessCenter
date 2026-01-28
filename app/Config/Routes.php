<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Landing::index');
$routes->get('daftar', 'DaftarController::index');
$routes->post('daftar/proses', 'DaftarController::proses');
$routes->get('daftar/sukses', 'DaftarController::sukses');
$routes->get('testupload', 'TestUploadController::index');
$routes->post('testupload', 'TestUploadController::index');

// Auth Routes
$routes->group('auth', function($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::processRegister');
    $routes->get('success', 'AuthController::success');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('forgot-password', 'AuthController::forgotPassword');
    $routes->post('forgot-password', 'AuthController::processForgotPassword');
    $routes->get('reset-password/(:any)', 'AuthController::resetPassword/$1');
    $routes->post('reset-password', 'AuthController::processResetPassword');
});

// Member Routes (Protected)
// Member Routes
$routes->group('member', ['filter' => 'member'], function($routes) {
    $routes->get('dashboard', 'MemberController::dashboard');
    $routes->get('profile', 'MemberController::profile');
    $routes->post('profile/update', 'MemberController::updateProfile');
    $routes->get('attendance', 'MemberController::attendance');
    $routes->get('booking', 'MemberController::booking');
    $routes->get('payment', 'MemberController::payment');
    $routes->get('logout', 'MemberController::logout');
});

// Admin Routes (sesuai controller yang sudah ada)
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('members', 'AdminController::members');
    $routes->get('members/view/(:num)', 'AdminController::viewMember/$1');
    $routes->post('members/update-status/(:num)', 'AdminController::updateMemberStatus/$1');
    $routes->get('manage-admins', 'AdminController::manageAdmins');
    $routes->post('manage-admins/create', 'AdminController::createAdmin');
    $routes->post('manage-admins/update-status/(:num)', 'AdminController::updateAdminStatus/$1');
    $routes->get('manage-admins/delete/(:num)', 'AdminController::deleteAdmin/$1');
    $routes->get('reports', 'AdminController::reports');
    $routes->get('settings', 'AdminController::settings');
    $routes->get('profile', 'AdminController::profile');
    $routes->post('profile/update', 'AdminController::updateProfile');
        $routes->get('members/create', 'AdminController::create');
    $routes->post('members/store', 'AdminController::store');
    $routes->get('members/edit/(:num)', 'AdminController::edit/$1');
    $routes->put('members/update/(:num)', 'AdminController::update/$1');
    $routes->post('members/delete/(:num)', 'AdminController::delete/$1');
});

// Auth Routes
$routes->group('auth', function($routes) {
    $routes->get('login', 'AuthController::login'); // untuk member
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');
});

// Admin Auth Routes
$routes->group('admin/auth', function($routes) {
    $routes->get('login', 'AdminAuthController::login');
    $routes->post('login', 'AdminAuthController::attemptLogin');
    $routes->get('logout', 'AdminAuthController::logout');
    $routes->get('forgot-password', 'AdminAuthController::forgotPassword');
    $routes->get('setup', 'AdminAuthController::setupSuperadmin');
    $routes->post('setup', 'AdminAuthController::processSetup');
});

// Test Routes
$routes->get('test-db-connection', 'DaftarController::testConnection');
$routes->match(['get', 'post'], 'testupload', 'TestUploadController::index');