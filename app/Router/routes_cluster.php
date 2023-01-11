<?php

$routes->get("/", "ClusterController::index");

// $routes->post("updateProfile", "TeacherController::updateProfile");
// $routes->post("getSchools", "TeacherController::getSchools");

// $routes->get("changePassword", "TeacherController::changePassword");
// $routes->post("updatePassword", "TeacherController::updatePassword");

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