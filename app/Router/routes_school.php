<?php

$routes->get("/", "SchoolController::index");

// $routes->post("updateProfile", "TeacherController::updateProfile");
// $routes->post("getSchools", "TeacherController::getSchools");

// เปลี่ยนรหัสผ่าน
$routes->get("changePassword", "SchoolController::changePassword");
$routes->post("updatePassword", "SchoolController::updatePassword");

// แก้ไขข้อมูลส่วนตัว
$routes->get("profile", "SchoolController::profile");
$routes->post("updateProfile", "SchoolController::updateProfile");

//เลือกที่อยู่
$routes->match(['get', 'post'], 'areaSearch', 'SchoolController::areaSearch');
$routes->match(['get', 'post'], 'schoolSearch', 'SchoolController::schoolSearch');
$routes->match(['get', 'post'], 'amphurSearch', 'SchoolController::amphurSearch');
$routes->match(['get', 'post'], 'tumbonSearch', 'SchoolController::tumbonSearch');

//จัดการผู้ใช้งานในโรงเรียน
$routes->get("users", "SchoolController::users");
$routes->get("addUser", "SchoolController::addUser");
$routes->post("insertUser", "SchoolController::insertUser");
$routes->get("confirmUser", "SchoolController::confirmUser");


$routes->match(['get', 'post'], "listTeachersData", "SchoolController::listTeachersData"); 

  
// //หลักสูตร
// $routes->get("manageMyCourses", "TeacherController::manageMyCourses");
// $routes->get("createCourse", "TeacherController::createCourse");
// $routes->post("saveCourse", "TeacherController::saveCourse");
// $routes->get("editCourse/(:num)", "TeacherController::editCourse/$1");
// $routes->post("updateCourse", "TeacherController::updateCourse");
// $routes->get("deleteCourse/(:num)", "TeacherController::deleteCourse/$1");
// $routes->get("deleteCoverCourse/(:num)", "TeacherController::deleteCoverCourse/$1");

// //หน่วยการเรียนรู้
// $routes->get("manageUnits/(:num)", "TeacherController::manageUnits/$1");
// $routes->get("createUnit/(:num)", "TeacherController::createUnit/$1");
// $routes->post("saveUnit", "TeacherController::saveUnit");
// $routes->get("editUnit/(:num)", "TeacherController::editUnit/$1");
// $routes->post("updateUnit", "TeacherController::updateUnit");
// $routes->get("deleteUnit/(:num)", "TeacherController::deleteUnit/$1");
// $routes->get("deleteDocumentUnit/(:num)", "TeacherController::deleteDocumentUnit/$1");

// //ข้อสอบ
// $routes->get("manageQuestions/(:num)", "TeacherController::manageQuestions/$1");
// $routes->get("createQuestion/(:num)", "TeacherController::createQuestion/$1");
// $routes->post("saveQuestion", "TeacherController::saveQuestion");
// $routes->get("editQuestion/(:num)", "TeacherController::editQuestion/$1");
// $routes->post("updateQuestion", "TeacherController::updateQuestion");
// $routes->get("deleteQuestion/(:num)", "TeacherController::deleteQuestion/$1");

// //เข้าเรียน
// $routes->get("registedCourse", "Courses::registedCourse"); 