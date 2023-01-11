<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AreasModel;
use App\Models\SchoolsModel;
use App\Models\CoursesModel;
use App\Models\CategorysModel;
use App\Models\UnitsModel;
use App\Models\QuestionsModel;
use App\Models\UsersModel;

class Pages extends Controller {

    public function __construct()
    {
		helper('functions');
        helper(['function', 'form']);
    }

    public function index() {
        // $usersModel = new UsersModel;
        // $areasModel = new AreasModel;
        // $schoolsModel = new SchoolsModel;
        // $courseModel = new CoursesModel;
        // $unitsModel = new UnitsModel;
        // $categorysModel = new CategorysModel;
        // $uestionsModel = new QuestionsModel;
		
		// $RowCate_1= $courseModel->getCourseByCateID(1);
		// $RowCate_2= $courseModel->getCourseByCateID(2);
		// $RowCate_3= $courseModel->getCourseByCateID(3);

        $data = [
				// 'users' => $usersModel->RowUsersTopCreate(5),
                // //'users' => $usersModel->where('status', '1')->orderBy('id', 'desc')->findAll(5),
                // 'RowCate_1' => $RowCate_1,
                // 'RowCate_2' => $RowCate_2,
                // 'RowCate_3' => $RowCate_3,
                // 'course' => $courseModel->where('c_status', '1')->orderBy('id', 'desc')->findAll(6),
                // 'pager' => $courseModel->pager,
                'title' => 'เข้าสู่ระบบ'
                ];
        return view('frontend/index',$data);
        
    }

    public function view($page = 'home') {
        if (!is_file(APPPATH.'/Views/'.$page.'.php')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page);
        echo view('templates/header', $data);
        echo view('frontend/'.$page, $data);
        echo view('templates/footer', $data);

    }


}