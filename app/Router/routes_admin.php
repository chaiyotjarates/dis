<?php

$routes->get("/", "AdminController::index");

// เปลี่ยนรหัสผ่าน
$routes->get("changePassword", "AdminController::changePassword");
$routes->post("updatePassword", "AdminController::updatePassword");

// แก้ไขข้อมูลส่วนตัว
$routes->get("profile", "AdminController::profile");
$routes->post("updateProfile", "AdminController::updateProfile");

// year
$routes->get("list_year", "AdminController::list_year");
$routes->get("del_year/(:num)", "AdminController::del_year/$1");
$routes->post("upstatus_year/(:num)", "AdminController::upstatus_year/$1");
$routes->get("add_year", "AdminController::add_year");
$routes->post("save_year", "AdminController::save_year");
$routes->get("edit_year/(:num)", "AdminController::edit_year/$1");
$routes->post("update_year", "AdminController::update_year");
$routes->post("upstatus_year", "AdminController::upstatus_year");

// config
$routes->get("list_config", "AdminController::list_config");
$routes->get("del_config/(:num)", "AdminController::del_config/$1");
$routes->post("upstatus_config", "AdminController::upstatus_config");
$routes->get("add_config", "AdminController::add_config");
$routes->post("save_config", "AdminController::save_config");
$routes->get("edit_config/(:num)", "AdminController::edit_config/$1");
$routes->post("update_config", "AdminController::update_config");

// admin_user
$routes->get("admin_user", "AdminController::admin_user");
$routes->get("getprofile_admin/(:num)", "AdminController::getprofile_admin/$1");
$routes->get("editprofile_admin/(:num)", "AdminController::editprofile_admin/$1");
$routes->post("updateprofile_admin", "AdminController::updateprofile_admin");
$routes->get("delmyadmin_user/(:num)", "AdminController::delmyadmin_user/$1");
$routes->post("upstatus_admin", "AdminController::upstatus_admin");
$routes->get("add_adminuser", "AdminController::add_adminuser");
$routes->post("save_adminuser", "AdminController::save_adminuser");

// area_user
$routes->get("area_user", "AdminController::area_user");
$routes->get("getprofile_area/(:num)", "AdminController::getprofile_area/$1");
$routes->get("editprofile_area/(:num)", "AdminController::editprofile_area/$1");
$routes->post("updateprofile_area", "AdminController::updateprofile_area");
$routes->get("delmyarea_user/(:num)", "AdminController::delmyarea_user/$1");
$routes->post("upstatus_area", "AdminController::upstatus_area");
$routes->get("add_areauser", "AdminController::add_areauser");
$routes->post("save_areauser", "AdminController::save_areauser");

// cluster_user
$routes->get("cluster_user", "AdminController::cluster_user");
$routes->get("getprofile_cluster/(:num)", "AdminController::getprofile_cluster/$1");
$routes->get("editprofile_cluster/(:num)", "AdminController::editprofile_cluster/$1");
$routes->post("updateprofile_cluster", "AdminController::updateprofile_cluster");
$routes->get("delmycluster_user/(:num)", "AdminController::delmycluster_user/$1");
$routes->post("upstatus_cluster", "AdminController::upstatus_cluster");
$routes->get("add_clusteruser", "AdminController::add_clusteruser");
$routes->post("save_clusteruser", "AdminController::save_clusteruser");

// user
$routes->get("get_user", "AdminController::get_user");
$routes->get("getprofile_user/(:num)", "AdminController::getprofile_user/$1");
$routes->get("editprofile_user/(:num)", "AdminController::editprofile_user/$1");
$routes->post("updateprofile_user", "AdminController::updateprofile_user");
$routes->get("delmy_user/(:num)", "AdminController::delmy_user/$1");
$routes->post("upstatus_user", "AdminController::upstatus_user");
$routes->get("add_user", "AdminController::add_user");
$routes->post("save_user", "AdminController::save_user");
$routes->get("find_User_Ajax", "AdminController::Find_User_Ajax");

// super_user
$routes->get("super_user", "AdminController::super_user");
$routes->get("getprofile_super/(:num)", "AdminController::getprofile_super/$1");
$routes->get("editprofile_super/(:num)", "AdminController::editprofile_super/$1");
$routes->post("updateprofile_super", "AdminController::updateprofile_super");
$routes->get("delmysuper_user/(:num)", "AdminController::delmysuper_user/$1");
$routes->post("upstatus_super", "AdminController::upstatus_super");
$routes->get("add_superuser", "AdminController::add_superuser");
$routes->post("save_superuser", "AdminController::save_superuser");


// // Manage User
// $routes->get("listUsers", "AdminController::listUsers");
// $routes->get("createUser", "AdminController::createUser");
// $routes->post("submit-form-storeUser", "AdminController::storeUser");
// $routes->get("editUser/(:num)", "AdminController::singleUser/$1");
// $routes->post("updateUser", "AdminController::updateUser");
// $routes->get("deleteUser/(:num)", "AdminController::deleteUser/$1");
// // Manage Profile
// $routes->get("profile", "AdminController::profile");
// $routes->post("updateProfile", "AdminController::updateProfile");

// //Change password
// $routes->get("changePassword", "AdminController::changePassword");
// $routes->post("updatePassword", "AdminController::updatePassword");

// //
// $routes->get("manageAllCourses", "AdminController::manageAllCourses");
// $routes->get("createAllCourse", "AdminController::createAllCourse");
// $routes->post("saveAllCourse", "AdminController::saveAllCourse");
// $routes->get("editAllCourse/(:num)", "AdminController::editAllCourse/$1");
// $routes->post("updateAllCourse", "AdminController::updateAllCourse");
// $routes->get("deleteAllCourse/(:num)", "AdminController::deleteAllCourse/$1");
// $routes->get("deleteAllCoverCourse/(:num)", "AdminController::deleteAllCoverCourse/$1");
// $routes->get("getAllCourse/(:num)", "AdminController::getAllCourse/$1");
// $routes->get("getAllCourse/(:num)/(:num)", "AdminController::getAllCourse/$1/$2");
// $routes->get("pretest/(:num)", "AdminController::pretest/$1");
// $routes->get("posttest/(:num)", "AdminController::posttest/$1");

// //
// $routes->get("manageMyCourses", "AdminController::manageMyCourses");
// $routes->get("createCourse", "AdminController::createCourse");
// $routes->post("saveCourse", "AdminController::saveCourse");
// $routes->get("editCourse/(:num)", "AdminController::editCourse/$1");
// $routes->post("updateCourse", "AdminController::updateCourse");
// $routes->get("deleteCourse/(:num)", "AdminController::deleteCourse/$1");
// $routes->get("deleteCoverCourse/(:num)", "AdminController::deleteCoverCourse/$1");
// $routes->get("getcourse/(:num)", "AdminController::getCourse/$1");

// //
// $routes->get("manageAllUnits", "AdminController::manageAllUnits");
// $routes->get("manageAllUnits/(:num)", "AdminController::manageAllUnits/$1");
// $routes->get("createAllUnit/(:num)", "AdminController::createAllUnit/$1");
// $routes->post("saveAllUnit", "AdminController::saveAllUnit");
// $routes->get("editAllUnit/(:num)", "AdminController::editAllUnit/$1");
// $routes->post("updateAllUnit", "AdminController::updateAllUnit");
// $routes->get("deleteAllUnits/(:num)", "AdminController::deleteAllUnits/$1");
// $routes->get("deleteAllDocumentUnit/(:num)", "AdminController::deleteAllDocumentUnit/$1");
// $routes->get("getAllUnit/(:num)", "AdminController::getAllUnit/$1");


// //
// $routes->get("manageUnits", "AdminController::manageUnits");
// $routes->get("manageUnits/(:num)", "AdminController::manageUnits/$1");
// $routes->get("createUnit/(:num)", "AdminController::createUnit/$1");
// $routes->post("saveUnit", "AdminController::saveUnit");
// $routes->get("editUnit/(:num)", "AdminController::editUnit/$1");
// $routes->post("updateUnit", "AdminController::updateUnit");
// $routes->get("deleteUnits/(:num)", "AdminController::deleteUnits/$1");
// $routes->get("deleteDocumentUnit/(:num)", "AdminController::deleteDocumentUnit/$1");

// //
// $routes->get("manageAllQuestions", "AdminController::manageAllQuestions");
// $routes->get("manageAllQuestions/(:num)", "AdminController::manageAllQuestions/$1");
// $routes->get("createAllQuestion/(:num)", "AdminController::createAllQuestion/$1");
// $routes->post("saveAllQuestion", "AdminController::saveAllQuestion");
// $routes->get("editAllQuestion/(:num)", "AdminController::editAllQuestion/$1");
// $routes->post("updateAllQuestion", "AdminController::updateAllQuestion");
// $routes->get("deleteAllQuestions/(:num)", "AdminController::deleteAllQuestion/$1");
// $routes->get("getAllQuestion/(:num)", "AdminController::getAllQuestion/$1");

// //
// $routes->get("manageQuestions", "AdminController::manageQuestions");
// $routes->get("manageQuestions/(:num)", "AdminController::manageQuestions/$1");
// $routes->get("createQuestion/(:num)", "AdminController::createQuestion/$1");
// $routes->post("saveQuestion", "AdminController::saveQuestion");
// $routes->get("editQuestion/(:num)", "AdminController::editQuestion/$1");
// $routes->post("updateQuestion", "AdminController::updateQuestion");
// $routes->get("deleteQuestions/(:num)", "AdminController::deleteQuestion/$1");

// //
// $routes->get("registedCourse", "Courses::registedCourse");

// //
// $routes->get("checkPropCourses", "AdminController::checkPropCourses");
// $routes->get("upstatusPropCourse/(:num)", "AdminController::upstatusPropCourse/$1");
// $routes->get("manageEval", "AdminController::manageEvals");
// $routes->get("manageFinEval", "AdminController::manageFinEvals");
// $routes->get("managePrntEval", "AdminController::managePrntEvals");
// $routes->get("getCourseEval/(:num)", "AdminController::getCourseEvals/$1");
// $routes->get("editCourseEval/(:num)", "AdminController::editCourseEvals/$1");
// $routes->get("createCourseEval/(:num)", "AdminController::createCourseEvals/$1");
// $routes->get("deleteCourseEval/(:num)", "AdminController::deleteCourseEvals/$1");
// $routes->post("saveCourseEval", "AdminController::saveCourseEvals");
// $routes->post("updateCourseEval", "AdminController::updateCourseEvals");
// $routes->get("printCourseEval/(:num)", "AdminController::printCourseEvals/$1");
// $routes->get("managePrntCard", "AdminController::managePrntCard");
// $routes->get("printCourseCard/(:num)", "AdminController::printCourseCard/$1");

// //
// $routes->get("statCourses", "AdminController::statCourses");
// $routes->get("statUsers", "AdminController::statUsers");
// $routes->get("statEval", "AdminController::statEvals");
