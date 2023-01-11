<?php

namespace Config;

$routes = Services::routes();

if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// Admin routes
$routes->group("admin", ["filter" => "authAdmin"], function ($routes) {

    require APPPATH . 'Router/routes_admin.php';
});

// Obec routes
$routes->group("obec", ["filter" => "authObec"], function ($routes) {

    require APPPATH . 'Router/routes_obec.php';
});

// Area routes
$routes->group("area", ["filter" => "authArea"], function ($routes) {

    require APPPATH . 'Router/routes_area.php';
});

// School routes
$routes->group("school", ["filter" => "authSchool"], function ($routes) {

    require APPPATH . 'Router/routes_school.php';
});

// Teacher routes
$routes->group("teacher", ["filter" => "authTeacher"], function ($routes) {

    require APPPATH . 'Router/routes_teacher.php';
});

// Cluster routes
$routes->group("cluster", ["filter" => "authCluster"], function ($routes) {

    require APPPATH . 'Router/routes_cluster.php';
});

// Allready Logged in
$routes->group("", ["filter" => "alreadyLoggedin"], function ($routes) {
    $routes->get('/login', 'Pages::index');
    $routes->get('/', 'Pages::index');
});

$routes->get('/', 'Pages::index');

//เข้าสู่ระบบ
$routes->get('/login', 'Pages::index');
$routes->post('/login/auth', 'Login::auth');

//ลงทะเบียน
$routes->get('/registerSchool', 'RegisterController::RegSchool');
$routes->get('/registerArea', 'RegisterController::RegArea');
$routes->get('/registerCluster', 'RegisterController::RegCluster');
$routes->get('/registerAdmin', 'RegisterController::RegAdmin');
$routes->get('/registerObec', 'RegisterController::RegObec');
$routes->post('/save_registerObec', 'RegisterController::saveRegObec');
$routes->post('/save_registerAdmin', 'RegisterController::saveRegAdmin');
$routes->post('/save_registerCluster', 'RegisterController::saveRegCluster');
$routes->post('/save_registerArea', 'RegisterController::saveRegArea');
$routes->post('/save_registerSchool', 'RegisterController::saveRegSchool');

//เลือกเขตฯโรงเรียน
$routes->post('/register/areaSearch', 'RegisterController::areaSearch');
$routes->post('/register/schoolSearch', 'RegisterController::schoolSearch');

//เลือกที่อยู่
//$routes->match(['get', 'post'], 'amphurSearch', 'RegisterController::amphurSearch');
//$routes->match(['get', 'post'], 'tumbonSearch', 'RegisterController::tumbonSearch');

//ลืมรหัสผ่าน
$routes->get('/forgotPassword', 'ForgotPasswordController::index');
$routes->post('/forgot', 'ForgotPasswordController::forgot');
$routes->get('/reset_password/(:any)/(:any)/(:any)', 'ForgotPasswordController::reset_password/$1/$2/$3');
$routes->post('/saveNewPassword', 'ForgotPasswordController::saveNewPassword');

//ออกจากระบบ
$routes->get('/logout', 'Login::logout');

$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

$routes->get('(:any)', 'Pages::view/$1');

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
 