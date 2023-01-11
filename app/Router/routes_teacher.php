<?php

$routes->get("/", "TeacherController::index");

// เปลี่ยนรหัสผ่าน
$routes->get("changePassword", "TeacherController::changePassword");
$routes->post("updatePassword", "TeacherController::updatePassword");
 
// ส่งผลงาน
$routes->get("sendAward", "TeacherController::sendAward");
$routes->post("insertAward", "TeacherController::insertAward");
$routes->get("status-award", "TeacherController::status_award");
$routes->get("cancelAward", "TeacherController::cancelAward");

// แก้ไขข้อมูลส่วนตัว
$routes->get("profile", "TeacherController::profile");
$routes->post("updateProfile", "TeacherController::updateProfile");

//เลือกที่อยู่
$routes->match(['get', 'post'], 'schoolSearch', 'TeacherController::schoolSearch');
$routes->match(['get', 'post'], 'amphurSearch', 'TeacherController::amphurSearch');
$routes->match(['get', 'post'], 'tumbonSearch', 'TeacherController::tumbonSearch');

//จัดการผู้ใช้งานในโรงเรียน
// $routes->get("users", "TeacherController::users");
// $routes->get("addUser", "TeacherController::addUser");
// $routes->post("insertUser", "TeacherController::insertUser");
// $routes->get("confirmUser", "TeacherController::confirmUser");
