<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AwardsModel;
use App\Models\PrefixModel;
use App\Models\AreasModel;
use App\Models\AreasUsersModel;
use App\Models\SchoolsModel;
use App\Models\ClustersModel;
use App\Models\ClustersUsersModel;
use App\Models\SupersUsersModel;
use App\Models\AdminsUsersModel;
use App\Models\AdminsOnlinesModel;
use App\Models\DisConfigsModel;
use App\Models\DisCatesModel;
use App\Models\DisYearsModel;
use App\Models\DisEvalsModel;
use App\Models\DisAreasEvalsModel;
use App\Models\DisSchoolsEvalsModel;

use CodeIgniter\Controller;

class AdminController extends Controller {

    function __construct(){

        helper(['functions']);
    
    }
        
    public function index() {

        $userModel = new UsersModel;
        $awardModel = new AwardsModel;
        $areaModel = new AreasModel;
        $schoolModel = new SchoolsModel;
        $clusterModel = new ClustersModel;
        $disConfigModel = new DisConfigsModel;
        $adminOnlineModel = new AdminsOnlinesModel;

        $data = [
            'title' => [
                '1' => 'Dashboard, Admin',
            ],
            'teacher' => $userModel->countAllResults(),
            'confirm' => $userModel->where('user_status', 'waiting')->countAllResults(),
            'award' => $awardModel->countAllResults(),
            'awardall' => $awardModel->countAllResults(),
            'config' => $disConfigModel->where('co_status', 'Active')->first(),
            'DateNow' => date("Y-m-d"),
            'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),
        ];
        echo view('admin/dashboard', $data);
    }


    public function profile()
    {
        $userModel = new UsersModel();
        $prefixModel = new PrefixModel();
        $areaModel = new AreasModel();
        $schoolsModel = new SchoolsModel;
        $areaModel = new AreasModel;
        $adminUserModel = new AdminsUsersModel;
        $clusterModel = new ClustersModel;
        $adminOnlineModel = new AdminsOnlinesModel;
    
        helper(['form']);
    
        $data = [
            'title' => [
            '1' => 'แก้ไขข้อมูลส่วนตัว'
            ],
            'user' => $adminUserModel->where('user_id', session()->get('user_id'))->first(),
            'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
            'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),
        ];
        echo view(session()->get('checktype').'/profile', $data);
    }
    
    public function updateProfile()
    {
        helper(array('form'));
    
        $rules = array(
        'user_prefix'    => array(
            'rules'  => 'required',
            'errors' => array(
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้',
            ),
        ),
        'user_fname' => array(
            'rules'  => 'required|min_length[2]|max_length[50]',
            'errors' => array(
            'required'   => 'ชื่อ ไม่สามารถเว้นว่างได้',
            'min_length' => 'ชื่อ อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'ชื่อ ใส่มากสุดได้ 50 ตัวอักษร',
            ),
        ), 
        'user_lname'  => array(
            'rules'  => 'required|min_length[2]|max_length[50]',
            'errors' => array(
            'required'   => 'นามสกุล ไม่สามารถเว้นว่างได้',
            'min_length' => 'นามสกุล อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'นามสกุล ใส่มากสุดได้ 50 ตัวอักษร',
            ),
        ),
        'user_email'  => array(
            'rules'  => 'required',
            'errors' => array(
            'required'   => 'อีเมล์ ไม่สามารถเว้นว่างได้'
            ),
        ),
        'user_phone'     => array(
            'rules'  => 'required|min_length[10]|max_length[20]',
            'errors' => array(
            'required'   => 'หมายเลขโทรศัพท์ ไม่สามารถเว้นว่างได้',
            'min_length' => 'หมายเลขโทรศัพท์ ให้ใส่ 10 หลัก',
            'max_length' => 'หมายเลขโทรศัพท์ เกินจำนวน',
            ),
        ),
        );
    
        if ($this->validate($rules)) {
    
            $adminUserModel = new AdminsUsersModel;
    
            $user_id = session()->get('user_id');
    
            if ($this->request->getFile('user_profile') != '') {
                $file = $this->request->getFile('user_profile');
                $user_profile = $file->getRandomName();
                $data = [
                    'user_profile' => $user_profile
                ];
    
                $file_old = $adminUserModel->where('user_id', $user_id)->first();
    
                if($file_old['user_profile'] != ""){
                    @unlink('uploads/profile/' . $file_old['user_profile']);
                }
    
                if ($file->move('uploads/profile/', $user_profile)) {
    
                \Config\Services::image()
                    ->withFile('uploads/profile/' . $user_profile)
                    ->fit(200, 200, 'center')
                    ->save('uploads/profile/' . $user_profile);
    
                }
    
                $adminUserModel->where('user_id', $user_id)->set($data)->update();
    
                $remove_data = [
                    'imgProfile'
                ];
                session()->remove($remove_data);
                session()->set($data);
            }
    
            $data = array(
                'user_prefix'    => $this->request->getVar('user_prefix'),
                'user_fname' => $this->request->getVar('user_fname'),
                'user_lname'  => $this->request->getVar('user_lname'),
                'user_email'   => $this->request->getVar('user_email'),
                'user_phone'   => $this->request->getVar('user_phone'),
                'imgProfile' => $user_profile,
            );
    
            $remove_data = [
                'prefix',
                'firstname',
                'lastname',
                'fullname',
                'email',
                'phone',
            ];
            session()->remove($remove_data);
            
            $ses_data = [
                //'imgProfile' => $user_profile,
                'prefix' => $this->request->getVar('user_prefix'),
                'firstname' => $this->request->getVar('user_fname'),
                'lastname' => $this->request->getVar('user_lname'),
                'fullname' => $this->request->getVar('user_prefix').$this->request->getVar('user_fname').' '.$this->request->getVar('user_lname'),
                'email' => $this->request->getVar('user_email'),    
                'phone' => $this->request->getVar('user_phone'),          
                'imgProfile' => $user_profile,
            ];
            session()->set($ses_data);
    
            $adminUserModel->update($user_id, $data);
    
            return redirect()->to(base_url(session()->get('checktype').'/profile'))->with('success', '<i class="far fa-check-circle fs-16"></i> ปรับปรุงข้อมูลส่วนตัวสำเร็จ');
    
        } else {
    
            helper(array('form'));
    
            $adminUserModel = new AdminsUsersModel();
            $prefixModel = new PrefixModel();
            $adminOnlineModel = new AdminsOnlinesModel;
 
            helper(['form']);
    
            $data = [
                'title' => [
                    '1' => 'แก้ไขข้อมูลส่วนตัว'
                ],
                'validation' => $this->validator,
                'user' => $adminUserModel->where('user_id', session()->get('user_id'))->first(),
                'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
                'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),

            ];
    
            echo view(session()->get('checktype').'/profile', $data);
    
        }
    }
    
    public function areaSearch()
    {
        $areaModel = new AreasModel;
        $code = json_decode($_POST["code"]);
        $data = $areaModel->where('area_code', $code)->findall();
    
        echo json_encode($data);
    }
    
    public function schoolSearch()
    {
        $schoolModel = new SchoolsModel;
        $code = json_decode($_POST["code"]);
        $data = $schoolModel->where('sch_area', $code)->findall();
    
        echo json_encode($data);
    }

    public function changePassword()
    {
    
        helper(['form']);
        $adminUserModel = new AdminsUsersModel;
        $adminOnlineModel = new AdminsOnlinesModel;
    
        $data = [
            'title' => [
            '1' => 'เปลี่ยนรหัสผ่าน'
            ],
            'user' => $adminUserModel->where('user_id',session()->get('user_id'))->first(),
            'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
        ];
        echo view(session()->get('checktype').'/changePassword', $data);
    }
    
    public function updatePassword()
    {
        helper(['form']);
    
        $rules = [
        'old_password' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'รหัสผ่านปัจจุบัน ไม่สามารถเว้นว่างได้'
            ]
        ],
        'new_password' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'รหัสผ่านใหม่ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'conf_password' => [
            'rules' => 'trim|required|matches[new_password]',
            'errors' => [
            'required' => 'ยืนยันรหัสผ่าน ไม่สามารถเว้นว่างได้',
            'matches' => 'การยืนยันรหัสผ่านใหม่ ไม่ตรงกัน'
            ]
        ]
        ];
    
        if ($this->validate($rules)) {
    
            $adminUsermodel = new AdminsUsersModel();
            $adminOnlineModel = new AdminsOnlinesModel;
    
            $chkPassword = $adminUsermodel->changePassword($this->request->getVar('old_password'), session()->get('user_id'));
    
            if ($chkPassword) {
                $data = [
                'user_password' => $this->request->getVar('new_password'),
                'user_hashpassword' => password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT),
                ];
                $adminUsermodel->where('user_id', session()->get('user_id'))->set($data)->update();
                return redirect()->to(base_url('/' . session()->get('checktype') . '/changePassword'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เปลี่ยนรหัสผ่านสำเร็จแล้ว');
            } else {
                return redirect()->to(base_url('/' . session()->get('checktype') . '/changePassword'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> รหัสผ่านปัจจุบันไม่ถูกต้อง');
            }
        } else {
    
            helper(['form']);
            $data = [
                'title' => [
                '1' => 'เปลี่ยนรหัสผ่าน',
                ],
                'validation' => $this->validator,
                'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),
            ];
            echo view(session()->get('checktype').'/changePassword', $data);
    
        }
    }

/////////////// year

public function list_year(){

    $disYearModel = new DisYearsModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'ปีการศึกษา'
        ],
        'year' => $disYearModel->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];
    echo view(session()->get('checktype').'/list_year', $data);

}

public function del_year($year_id)
{

    $disYearModel = new DisYearsModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    if(!empty($year_id)){

        $disYearModel->delete($year_id);
        return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('success', '<i class="fe fe-check-circle fs-16"></i> ลบข้อมูลสำเร็จแล้ว');

    }else{

        return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> ไม่สามารถลบข้อมูลได้');

    }
}

public function upstatus_year()
{
    $disYearModel = new DisYearsModel;

    $year_id= $this->request->getVar('my_checkbox_value');

    $Year = $disYearModel->where('y_id',$year_id)->first();

    if($Year['y_status'] !="Active"){
        $data = [
            'y_status' => "Active"
        ];
        $up = $disYearModel->where('y_id', $Year['y_id'])->set($data)->update();
    
    } else {
        $data = [
            'y_status' => "ไม่อนุมัติ"
        ];
        $up = $disYearModel->where('y_id', $Year['y_id'])->set($data)->update();
    }

    if($up){
        return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แก้ไขข้อมูลสำเร็จแล้ว');
    }else{
        return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }
}

public function add_year()
{
    helper(['form']);
    $disYearModel = new DisYearsModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'เพิ่มช้อมูลปีการศึกษา'
        ],
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];
    echo view(session()->get('checktype').'/add_year', $data);

}

public function save_year()
{
    helper(['form']);
    $rules = [
        'y_name' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'ปีการศึกษา ไม่สามารถเว้นว่างได้'
            ]
        ],

        ];

    if ($this->validate($rules)) {

        $disYearModel = new DisYearsModel;

        $data = [
            'y_name' => $this->request->getVar('y_name'),
            'y_posted' => session()->get('user_id'),
            'y_posted_date' => date("Y-m-d H:i:s")
        ];

        $disYearModel->save($data);
        return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เพิ่มข้อมูลสำเร็จแล้ว');
        //return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> รหัสผ่านปัจจุบันไม่ถูกต้อง');
        
    } else {

        return redirect()->to(base_url('/' . session()->get('checktype') . '/add_year'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> เพิ่มข้อมูลไม่สำเร็จ');
    }

}

public function edit_year($year_id)
{
    helper(['form']);
    $disYearModel = new DisYearsModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'แก้ไขช้อมูลปีการศึกษา'
        ],
        'year' => $disYearModel->where('y_id',$year_id)->first(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];
    echo view(session()->get('checktype').'/edit_year', $data);

}

public function update_year()
{

    helper(['form']);
    $rules = [
        'y_name' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'ปีการศึกษา ไม่สามารถเว้นว่างได้'
            ]
        ],

        ];

    if ($this->validate($rules)) {

        $disYearModel = new DisYearsModel;

        $data = [
            'y_name' => $this->request->getVar('y_name'),
            'y_posted' => session()->get('user_id'),
            'y_posted_date' => date("Y-m-d H:i:s")
        ];

        $disYearModel->where('y_id', $this->request->getVar('y_id'))->set($data)->update();
        return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แก้ไขข้อมูลสำเร็จแล้ว');
        //return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> รหัสผ่านปัจจุบันไม่ถูกต้อง');
        
    } else {

        return redirect()->to(base_url('/' . session()->get('checktype') . '/edit_year/'.$this->request->getVar('y_id')))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');

    }
}


/////////////// cofnig

public function list_config(){

    $disConfigModel = new DisConfigsModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'กำหนดการประเมิน'
        ],
        'config' => $disConfigModel->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];
    echo view(session()->get('checktype').'/list_config', $data);

}

public function del_config($co_id)
{

    $disConfigModel = new DisConfigsModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    if(!empty($co_id)){

        $disConfigModel->delete($co_id);
        return redirect()->to(base_url('/' . session()->get('checktype') . '/list_config'))->with('success', '<i class="fe fe-check-circle fs-16"></i> ลบข้อมูลสำเร็จแล้ว');

    }else{

        return redirect()->to(base_url('/' . session()->get('checktype') . '/list_config'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> ไม่สามารถลบข้อมูลได้');

    }

}

public function upstatus_config()
{

    $disConfigModel = new DisConfigsModel;

    $co_id= $this->request->getVar('my_checkbox_value');

    $Con = $disConfigModel->where('co_id',$co_id)->first();

    if($Con['co_status'] !="Active"){
        $data = [
            'co_status' => "Active"
        ];
        $up = $disConfigModel->where('co_id', $Con['co_id'])->set($data)->update();
    
    } else {
        $data = [
            'co_status' => "ไม่อนุมัติ"
        ];
        $up = $disConfigModel->where('co_id', $Con['co_id'])->set($data)->update();
    }

    if($up){
        return redirect()->to(base_url('/' . session()->get('checktype') . '/list_config'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แก้ไขข้อมูลสำเร็จแล้ว');
    }else{
        return redirect()->to(base_url('/' . session()->get('checktype') . '/list_config'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }

}

public function add_config()
{
    helper(['form']);
    $disConfigModel = new DisConfigsModel;
    $adminOnlineModel = new AdminsOnlinesModel;
    $disyearModel = new DisYearsModel;

    $data = [
        'title' => [
        '1' => 'กำหนดการประเมินใหม่'
        ],
        'config' => $disConfigModel->findall(),
        'year' => $disyearModel->where('y_status','Active')->orderby('y_id','ASC')->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];
    echo view(session()->get('checktype').'/add_config', $data);

}

public function save_config()
{

    helper(['form']);
    $rules = [
        'co_year' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'ปีการศึกษา ไม่สามารถเว้นว่างได้'
            ]
        ],
        'co_title' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'รายละเอียด ไม่สามารถเว้นว่างได้'
            ]
        ],
        'co_date_start' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันเริ่มโครงการ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'co_date_end' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันสิ้นสุดโครงการ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'co_areascore_start' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันเขตฯพื้นที่ฯเริ่มการประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],
        'co_areascore_end' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันเขตพื้นที่ฯสิ้นสุดการประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],    
        'co_clusscore_start' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันเขตตรวจราชการเริ่มการประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],     
        'co_clusscore_end' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันเขตตรวจราชการสิ้นสุดการให้คะแนน ไม่สามารถเว้นว่างได้'
            ]
        ],     
        'co_datenote_start' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วัน สพฐ.ตั้งคณะกรรมกรประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],            
        'co_datenote_end' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วัน สพฐ.สิ้นสุดตั้งคณะกรรมกรประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],   
        'co_datescore_start' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วัน สพฐ.เริ่มการประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],           
        'co_datescore_end' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วัน สพฐ.สิ้นสุดการประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],         
        'co_datepublish' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันประกาศผล ไม่สามารถเว้นว่างได้'
            ]
        ], 

    ];

    if ($this->validate($rules)) {

        $disConfigModel = new DisConfigsModel;
        $adminOnlineModel = new AdminsOnlinesModel;
        $disyearModel = new DisYearsModel;

        $data = [
            'co_year' => $this->request->getVar('co_year'),
            'co_title' => $this->request->getVar('co_title'),
            'co_date_start' => $this->request->getVar('co_date_start'),
            'co_date_end' => $this->request->getVar('co_date_end'),
            'co_areascore_start' => $this->request->getVar('co_areascore_start'),
            'co_areascore_end' => $this->request->getVar('co_areascore_end'),
            'co_clusscore_start' => $this->request->getVar('co_clusscore_start'),
            'co_clusscore_end' => $this->request->getVar('co_clusscore_end'),
            'co_datenote_start' => $this->request->getVar('co_datenote_start'),
            'co_datenote_end' => $this->request->getVar('co_datenote_end'),
            'co_datescore_start' => $this->request->getVar('co_datescore_start'),
            'co_datescore_end' => $this->request->getVar('co_datescore_end'),
            'co_datepublish' => $this->request->getVar('co_datepublish'),
            'co_posted' => session()->get('user_id'),
            'co_posted_date' => date("Y-m-d H:i:s"),
            'co_status' => 'Active'

        ];

        $disConfigModel->save($data);
        return redirect()->to(base_url('/' . session()->get('checktype') . '/list_config'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เพิ่มข้อมูลสำเร็จแล้ว');
        //return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> รหัสผ่านปัจจุบันไม่ถูกต้อง');
        
    } else {

        return redirect()->to(base_url('/' . session()->get('checktype') . '/add_config'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> เพิ่มข้อมูลไม่สำเร็จ');
    }

}

public function edit_config($co_id)
{
    helper(['form']);
    $disConfigModel = new DisConfigsModel;
    $adminOnlineModel = new AdminsOnlinesModel;
    $disyearModel = new DisYearsModel;

    $data = [
        'title' => [
        '1' => 'กำหนดการประเมินใหม่'
        ],
        'config' => $disConfigModel->where('co_id',$co_id)->first(),
        'year' => $disyearModel->where('y_status','Active')->orderby('y_id','ASC')->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/edit_config', $data);

}

public function update_config()
{

    helper(['form']);
    $rules = [
        'co_year' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'ปีการศึกษา ไม่สามารถเว้นว่างได้'
            ]
        ],
        'co_title' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'รายละเอียด ไม่สามารถเว้นว่างได้'
            ]
        ],
        'co_date_start' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันเริ่มโครงการ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'co_date_end' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันสิ้นสุดโครงการ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'co_areascore_start' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันเขตฯพื้นที่ฯเริ่มการประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],
        'co_areascore_end' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันเขตพื้นที่ฯสิ้นสุดการประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],    
        'co_clusscore_start' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันเขตตรวจราชการเริ่มการประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],     
        'co_clusscore_end' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันเขตตรวจราชการสิ้นสุดการให้คะแนน ไม่สามารถเว้นว่างได้'
            ]
        ],     
        'co_datenote_start' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วัน สพฐ.ตั้งคณะกรรมกรประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],            
        'co_datenote_end' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วัน สพฐ.สิ้นสุดตั้งคณะกรรมกรประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],   
        'co_datescore_start' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วัน สพฐ.เริ่มการประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],           
        'co_datescore_end' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วัน สพฐ.สิ้นสุดการประเมิน ไม่สามารถเว้นว่างได้'
            ]
        ],         
        'co_datepublish' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'วันประกาศผล ไม่สามารถเว้นว่างได้'
            ]
        ], 

    ];

    if ($this->validate($rules)) {

        $disConfigModel = new DisConfigsModel;
        $adminOnlineModel = new AdminsOnlinesModel;
        $disyearModel = new DisYearsModel;

        $data = [
            'co_year' => $this->request->getVar('co_year'),
            'co_title' => $this->request->getVar('co_title'),
            'co_date_start' => $this->request->getVar('co_date_start'),
            'co_date_end' => $this->request->getVar('co_date_end'),
            'co_areascore_start' => $this->request->getVar('co_areascore_start'),
            'co_areascore_end' => $this->request->getVar('co_areascore_end'),
            'co_clusscore_start' => $this->request->getVar('co_clusscore_start'),
            'co_clusscore_end' => $this->request->getVar('co_clusscore_end'),
            'co_datenote_start' => $this->request->getVar('co_datenote_start'),
            'co_datenote_end' => $this->request->getVar('co_datenote_end'),
            'co_datescore_start' => $this->request->getVar('co_datescore_start'),
            'co_datescore_end' => $this->request->getVar('co_datescore_end'),
            'co_datepublish' => $this->request->getVar('co_datepublish'),
            'co_posted' => session()->get('user_id'),
            'co_posted_date' => date("Y-m-d H:i:s"),
            'co_status' => 'Active'

        ];

        $disConfigModel->where('co_id', $this->request->getVar('co_id'))->set($data)->update();
        return redirect()->to(base_url('/' . session()->get('checktype') . '/list_config'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แกไขข้อมูลสำเร็จแล้ว');
        //return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> รหัสผ่านปัจจุบันไม่ถูกต้อง');
        
    } else {
        return redirect()->to(base_url('/' . session()->get('checktype') . '/edit_config/'.$this->request->getVar('co_id')))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }

}

//////////////////// admin_user

public function admin_user()
{
    helper(['form']);
    $adminsUsersModel = new AdminsUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'รายการผู้ดูแลระบบ'
        ],
        'user' => $adminsUsersModel->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/admin_user', $data);

}

public function getprofile_admin($user_id)
{
    helper(['form']);
    $adminsUsersModel = new AdminsUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'ข้อมูลส่วนตัว '
        ],
        'user' => $adminsUsersModel->where('user_id',$user_id)->first(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/getprofile_admin', $data);

}

public function editprofile_admin($user_id)
{
    helper(['form']);
    $adminsUsersModel = new AdminsUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;
    $prefixModel = new PrefixModel;

    $data = [
        'title' => [
        '1' => 'แก้ไขข้อมูลส่วนตัว '
        ],
        'prefix' => $prefixModel->findall(),
        'user' => $adminsUsersModel->where('user_id',$user_id)->first(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/editprofile_admin', $data);
    
}

public function updateprofile_admin(){		

    helper(['form']);
    $rules = [
        'user_prefix' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_fname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'ชื่อ ไม่สามารถเว้นว่างได้',
            'min_length' => 'ชื่อ อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'ชื่อ ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_lname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'นามสกุล ไม่สามารถเว้นว่างได้',
            'min_length' => 'นามสกุล อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'นามสกุล ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_email' => [
            'rules' => 'trim|required|valid_email',
            'errors' => [
            'required' => 'รูปแบบอีเมล์ไม่ถูกต้อง'
            ]
        ],
        'user_phone' => [
            'rules' => 'required|min_length[10]|max_length[20]',
            'errors' => [
            'required'   => 'หมายเลขโทรศัพท์ ไม่สามารถเว้นว่างได้',
            'min_length' => 'หมายเลขโทรศัพท์ ให้ใส่ 10 หลัก',
            'max_length' => 'หมายเลขโทรศัพท์ เกินจำนวน',
            ]
        ],
        'user_role' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'สิทธิ์การใช้งาน ไม่สามารถเว้นว่างได้'
            ]
        ],
    ];

    if ($this->validate($rules)) {

        $adminUserModel = new AdminsUsersModel;
        $adminOnlineModel = new AdminsOnlinesModel;

        $user_id = $this->request->getVar('user_id');

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();
            $data = [
                'user_profile' => $user_profile
            ];

            $file_old = $adminUserModel->where('user_id', $user_id)->first();

            if($file_old['user_profile'] != ""){
                @unlink('uploads/profile/' . $file_old['user_profile']);
            }

            if ($file->move('uploads/profile/', $user_profile)) {

            \Config\Services::image()
                ->withFile('uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('uploads/profile/' . $user_profile);

            }

            $adminUserModel->where('user_id', $user_id)->set($data)->update();
        }

        $data = [
            'user_prefix' => $this->request->getVar('user_prefix'),
            'user_fname' => $this->request->getVar('user_fname'),
            'user_lname' => $this->request->getVar('user_lname'),
            'user_email' => $this->request->getVar('user_email'),
            'user_phone' => $this->request->getVar('user_phone'),
            'user_role' => $this->request->getVar('user_role'),
            //'user_profile' => $user_profile,
        ];

        $adminUserModel->where('user_id', $this->request->getVar('user_id'))->set($data)->update();
        return redirect()->to(base_url('/' . session()->get('checktype') . '/admin_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แกไขข้อมูลสำเร็จแล้ว');
        //return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> รหัสผ่านปัจจุบันไม่ถูกต้อง');
        
    } else {
        return redirect()->to(base_url('/' . session()->get('checktype') . '/editprofile_admin/'.$this->request->getVar('user_id')))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }

}

public function delmyadmin_user($user_id)
{

    $adminUsersModel = new AdminsUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    if(!empty($user_id)){

        $adminUsersModel->delete($user_id);
        return redirect()->to(base_url('/' . session()->get('checktype') . '/admin_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> ลบข้อมูลสำเร็จแล้ว');

    }else{

        return redirect()->to(base_url('/' . session()->get('checktype') . '/admin_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> ไม่สามารถลบข้อมูลได้');

    }

}

public function upstatus_admin()
{

    $adminUsersModel = new AdminsUsersModel;

    $user_id= $this->request->getVar('my_checkbox_value');

    $User = $adminUsersModel->where('user_id',$user_id)->first();

    if($User['user_status'] !="Active"){
        $data = [
            'user_status' => "Active"
        ];
        $up = $adminUsersModel->where('user_id', $User['user_id'])->set($data)->update();
    
    } else {
        $data = [
            'user_status' => "ไม่อนุมัติ"
        ];
        $up = $adminUsersModel->where('user_id', $User['user_id'])->set($data)->update();
    }

    if($up){
        return redirect()->to(base_url('/' . session()->get('checktype') . '/admin_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แก้ไขข้อมูลสำเร็จแล้ว');
    }else{
        return redirect()->to(base_url('/' . session()->get('checktype') . '/admin_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }

}

public function add_adminuser()
{
    helper(['form']);
    $adminsUsersModel = new AdminsUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;
    $prefixModel = new PrefixModel;

    $data = [
        'title' => [
        '1' => 'เพิ่มข้อมูลสมาชิกใหม่ '
        ],
        'prefix' => $prefixModel->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/add_adminuser', $data);

}

public function save_adminuser()
{

    helper(['form']);
    $rules = [
        'user_prefix' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_fname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'ชื่อ ไม่สามารถเว้นว่างได้',
            'min_length' => 'ชื่อ อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'ชื่อ ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_lname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'นามสกุล ไม่สามารถเว้นว่างได้',
            'min_length' => 'นามสกุล อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'นามสกุล ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_email' => [
            'rules' => 'trim|required|valid_email',
            'errors' => [
            'required' => 'รูปแบบอีเมล์ไม่ถูกต้อง'
            ]
        ],
        'user_phone' => [
            'rules' => 'required|min_length[10]|max_length[20]',
            'errors' => [
            'required'   => 'หมายเลขโทรศัพท์ ไม่สามารถเว้นว่างได้',
            'min_length' => 'หมายเลขโทรศัพท์ ให้ใส่ 10 หลัก',
            'max_length' => 'หมายเลขโทรศัพท์ เกินจำนวน',
            ]
        ],
        'password' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'รหัสผ่านใหม่ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_role' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'สิทธิ์การใช้งาน ไม่สามารถเว้นว่างได้'
            ]
        ],
    ];

    if ($this->validate($rules)) {

        $adminUserModel = new AdminsUsersModel;

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();

            \Config\Services::image()
                ->withFile('uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('uploads/profile/' . $user_profile);

        } else {
            $user_profile = '';
        }
        $data = [
            'user_prefix' => $this->request->getVar('user_prefix'),
            'user_idcard' => $this->request->getVar('user_idcard'),
            'user_fname' => $this->request->getVar('user_fname'),
            'user_lname' => $this->request->getVar('user_lname'),
            'user_email' => $this->request->getVar('user_email'),
            'user_phone' => $this->request->getVar('user_phone'),
            'user_profile' => $user_profile,
            'user_role' => $this->request->getVar('user_role'),
            'user_password' => $this->request->getVar('password'),
            'user_hashpassword' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $adminUserModel->save($data);
            return redirect()->to(base_url('/' . session()->get('checktype') . '/admin_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เพิ่มข้อมูลสำเร็จแล้ว');
            
    } else {
    
            return redirect()->to(base_url('/' . session()->get('checktype') . '/admin_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> เพิ่มข้อมูลไม่สำเร็จ');
    }

}

//////////////////// area_user

public function area_user()
{
    helper(['form']);
    $areasUsersModel = new AreasUsersModel;
    $areasModel = new AreasModel;
    $clustersModel = new ClustersModel;
    $areasUsersModel = new AreasUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'รายการผู้ใช้งานเขตฯ'
        ],
        'cluster' => $clustersModel->findall(),
        'area' => $areasModel->findall(),
        'user' => $areasUsersModel->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/area_user', $data);

}

public function getprofile_area($user_id)
{
    helper(['form']);
    $areasModel = new AreasModel;
    $clustersModel = new ClustersModel;
    $areasUsersModel = new AreasUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'ข้อมูลส่วนตัว '
        ],
        'cluster' => $clustersModel->findall(),
        'area' => $areasModel->findall(),
        'user' => $areasUsersModel->where('user_id',$user_id)->first(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/getprofile_area', $data);

}

public function editprofile_area($user_id)
{
    helper(['form']);
    $areasModel = new AreasModel;
    $clustersModel = new ClustersModel;
    $areasUsersModel = new AreasUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;
    $prefixModel = new PrefixModel;
    $areaUser = $areasUsersModel->where('user_id',$user_id)->first();
    $data = [
        'title' => [
        '1' => 'แก้ไขข้อมูลส่วนตัว '
        ],
        'cluster' => $clustersModel->findall(),
        'area' => $areasModel->where('area_code',$areaUser['user_area'])->findall(),
        'prefix' => $prefixModel->findall(),
        'user' => $areasUsersModel->where('user_id',$user_id)->first(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/editprofile_area', $data);
    
}

public function updateprofile_area(){		

    helper(['form']);
    $rules = [
        'user_clus' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'เขตตรวจราชการ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_area' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'เขตพื้นที่ฯ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_prefix' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_fname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'ชื่อ ไม่สามารถเว้นว่างได้',
            'min_length' => 'ชื่อ อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'ชื่อ ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_lname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'นามสกุล ไม่สามารถเว้นว่างได้',
            'min_length' => 'นามสกุล อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'นามสกุล ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_email' => [
            'rules' => 'trim|required|valid_email',
            'errors' => [
            'required' => 'รูปแบบอีเมล์ไม่ถูกต้อง'
            ]
        ],
        'user_phone' => [
            'rules' => 'required|min_length[10]|max_length[20]',
            'errors' => [
            'required'   => 'หมายเลขโทรศัพท์ ไม่สามารถเว้นว่างได้',
            'min_length' => 'หมายเลขโทรศัพท์ ให้ใส่ 10 หลัก',
            'max_length' => 'หมายเลขโทรศัพท์ เกินจำนวน',
            ]
        ],
        'user_role' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'สิทธิ์การใช้งาน ไม่สามารถเว้นว่างได้'
            ]
        ],
    ];

    if ($this->validate($rules)) {

        $areaUserModel = new AreasUsersModel;
        $adminOnlineModel = new AdminsOnlinesModel;

        $user_id = $this->request->getVar('user_id');

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();
            $data = [
                'user_profile' => $user_profile
            ];

            $file_old = $areaUserModel->where('user_id', $user_id)->first();

            if($file_old['user_profile'] != ""){
                @unlink('uploads/profile/' . $file_old['user_profile']);
            }

            if ($file->move('uploads/profile/', $user_profile)) {

            \Config\Services::image()
                ->withFile('uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('uploads/profile/' . $user_profile);

            }

            $areaUserModel->where('user_id', $user_id)->set($data)->update();
        }

        $data = [
            'user_clus' => $this->request->getVar('user_clus'),
            'user_area' => $this->request->getVar('user_area'),
            'user_prefix' => $this->request->getVar('user_prefix'),
            'user_fname' => $this->request->getVar('user_fname'),
            'user_lname' => $this->request->getVar('user_lname'),
            'user_email' => $this->request->getVar('user_email'),
            'user_phone' => $this->request->getVar('user_phone'),
            'user_role' => $this->request->getVar('user_role'),
            //'user_profile' => $user_profile,
        ];

        $areaUserModel->where('user_id', $this->request->getVar('user_id'))->set($data)->update();
        return redirect()->to(base_url('/' . session()->get('checktype') . '/area_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แกไขข้อมูลสำเร็จแล้ว');
        //return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> รหัสผ่านปัจจุบันไม่ถูกต้อง');
        
    } else {
        return redirect()->to(base_url('/' . session()->get('checktype') . '/editprofile_area/'.$this->request->getVar('user_id')))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }

}

public function delmyarea_user($user_id)
{

    $areaUsersModel = new AreasUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    if(!empty($user_id)){

        $areaUsersModel->delete($user_id);
        return redirect()->to(base_url('/' . session()->get('checktype') . '/area_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> ลบข้อมูลสำเร็จแล้ว');

    }else{

        return redirect()->to(base_url('/' . session()->get('checktype') . '/area_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> ไม่สามารถลบข้อมูลได้');

    }

}

public function upstatus_area()
{

    $areaUsersModel = new AreasUsersModel;

    $user_id= $this->request->getVar('my_checkbox_value');

    $User = $areaUsersModel->where('user_id',$user_id)->first();

    if($User['user_status'] !="Active"){
        $data = [
            'user_status' => "Active"
        ];
        $up = $areaUsersModel->where('user_id', $User['user_id'])->set($data)->update();
    
    } else {
        $data = [
            'user_status' => "ไม่อนุมัติ"
        ];
        $up = $areaUsersModel->where('user_id', $User['user_id'])->set($data)->update();
    }

    if($up){
        return redirect()->to(base_url('/' . session()->get('checktype') . '/area_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แก้ไขข้อมูลสำเร็จแล้ว');
    }else{
        return redirect()->to(base_url('/' . session()->get('checktype') . '/area_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }

}

public function add_areauser()
{
    helper(['form']);
    $areasModel = new AreasModel;
    $clustersModel = new ClustersModel;
    $areasUsersModel = new AreasUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;
    $prefixModel = new PrefixModel;

    $data = [
        'title' => [
        '1' => 'เพิ่มข้อมูลสมาชิกใหม่ '
        ],
        'cluster' => $clustersModel->findall(),
        'area' => $areasModel->findall(),
        'prefix' => $prefixModel->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/add_areauser', $data);

}

public function save_areauser()
{

    helper(['form']);
    $rules = [
        'user_clus' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'เขตตรวจราชการ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_area' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'เขตพื้นที่ฯ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_prefix' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_fname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'ชื่อ ไม่สามารถเว้นว่างได้',
            'min_length' => 'ชื่อ อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'ชื่อ ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_lname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'นามสกุล ไม่สามารถเว้นว่างได้',
            'min_length' => 'นามสกุล อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'นามสกุล ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_email' => [
            'rules' => 'trim|required|valid_email',
            'errors' => [
            'required' => 'รูปแบบอีเมล์ไม่ถูกต้อง'
            ]
        ],
        'user_phone' => [
            'rules' => 'required|min_length[10]|max_length[20]',
            'errors' => [
            'required'   => 'หมายเลขโทรศัพท์ ไม่สามารถเว้นว่างได้',
            'min_length' => 'หมายเลขโทรศัพท์ ให้ใส่ 10 หลัก',
            'max_length' => 'หมายเลขโทรศัพท์ เกินจำนวน',
            ]
        ],
        'password' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'รหัสผ่านใหม่ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_role' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'สิทธิ์การใช้งาน ไม่สามารถเว้นว่างได้'
            ]
        ],
    ];

    if ($this->validate($rules)) {
        $areasModel = new AreasModel;
        $clustersModel = new ClustersModel;
        $areaUserModel = new AreasUsersModel;

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();

            \Config\Services::image()
                ->withFile('uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('uploads/profile/' . $user_profile);

        } else {
            $user_profile = '';
        }
        $data = [
            'user_clus' => $this->request->getVar('user_clus'),
            'user_area' => $this->request->getVar('user_area'),
            'user_prefix' => $this->request->getVar('user_prefix'),
            'user_idcard' => $this->request->getVar('user_idcard'),
            'user_fname' => $this->request->getVar('user_fname'),
            'user_lname' => $this->request->getVar('user_lname'),
            'user_email' => $this->request->getVar('user_email'),
            'user_phone' => $this->request->getVar('user_phone'),
            'user_role' => $this->request->getVar('user_role'),
            'user_profile' => $user_profile,
            'user_password' => $this->request->getVar('password'),
            'user_hashpassword' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $areaUserModel->save($data);
            return redirect()->to(base_url('/' . session()->get('checktype') . '/area_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เพิ่มข้อมูลสำเร็จแล้ว');
            
    } else {
    
            return redirect()->to(base_url('/' . session()->get('checktype') . '/area_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> เพิ่มข้อมูลไม่สำเร็จ');
    }

}


//////////////////// cluster_user

public function cluster_user()
{
    helper(['form']);
    $clustersUsersModel = new ClustersUsersModel;
    $clustersModel = new ClustersModel;
    $clustersUsersModel = new ClustersUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'รายการผู้ใช้งานเขตตรวจราชการ'
        ],
        'cluster' => $clustersModel->findall(),
        'user' => $clustersUsersModel->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/cluster_user', $data);

}

public function getprofile_cluster($user_id)
{
    helper(['form']);
    $clustersModel = new ClustersModel;
    $clustersUsersModel = new ClustersUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'ข้อมูลส่วนตัว '
        ],
        'cluster' => $clustersModel->findall(),
        'user' => $clustersUsersModel->where('user_id',$user_id)->first(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/getprofile_cluster', $data);

}

public function editprofile_cluster($user_id)
{
    helper(['form']);
    $clustersModel = new ClustersModel;
    $clustersUsersModel = new ClustersUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;
    $prefixModel = new PrefixModel;
    $clusterUser = $clustersUsersModel->where('user_id',$user_id)->first();
    $data = [
        'title' => [
        '1' => 'แก้ไขข้อมูลส่วนตัว '
        ],
        'cluster' => $clustersModel->findall(),
//        'cluster' => $clustersModel->where('cluster_code',$clusterUser['user_cluster'])->findall(),
        'prefix' => $prefixModel->findall(),
        'user' => $clustersUsersModel->where('user_id',$user_id)->first(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/editprofile_cluster', $data);
    
}

public function updateprofile_cluster(){		

    helper(['form']);
    $rules = [
        'user_clus' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'เขตตรวจราชการ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_prefix' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_fname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'ชื่อ ไม่สามารถเว้นว่างได้',
            'min_length' => 'ชื่อ อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'ชื่อ ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_lname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'นามสกุล ไม่สามารถเว้นว่างได้',
            'min_length' => 'นามสกุล อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'นามสกุล ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_email' => [
            'rules' => 'trim|required|valid_email',
            'errors' => [
            'required' => 'รูปแบบอีเมล์ไม่ถูกต้อง'
            ]
        ],
        'user_phone' => [
            'rules' => 'required|min_length[10]|max_length[20]',
            'errors' => [
            'required'   => 'หมายเลขโทรศัพท์ ไม่สามารถเว้นว่างได้',
            'min_length' => 'หมายเลขโทรศัพท์ ให้ใส่ 10 หลัก',
            'max_length' => 'หมายเลขโทรศัพท์ เกินจำนวน',
            ]
        ],
        'user_role' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'สิทธิ์การใช้งาน ไม่สามารถเว้นว่างได้'
            ]
        ],
    ];

    if ($this->validate($rules)) {

        $clusterUserModel = new ClustersUsersModel;
        $adminOnlineModel = new AdminsOnlinesModel;

        $user_id = $this->request->getVar('user_id');

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();
            $data = [
                'user_profile' => $user_profile
            ];

            $file_old = $clusterUserModel->where('user_id', $user_id)->first();

            if($file_old['user_profile'] != ""){
                @unlink('uploads/profile/' . $file_old['user_profile']);
            }

            if ($file->move('uploads/profile/', $user_profile)) {

            \Config\Services::image()
                ->withFile('uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('uploads/profile/' . $user_profile);

            }

            $clusterUserModel->where('user_id', $user_id)->set($data)->update();
        }

        $data = [
            'user_clus' => $this->request->getVar('user_clus'),
            'user_prefix' => $this->request->getVar('user_prefix'),
            'user_fname' => $this->request->getVar('user_fname'),
            'user_lname' => $this->request->getVar('user_lname'),
            'user_email' => $this->request->getVar('user_email'),
            'user_phone' => $this->request->getVar('user_phone'),
            'user_role' => $this->request->getVar('user_role'),
            //'user_profile' => $user_profile,
        ];

        $clusterUserModel->where('user_id', $this->request->getVar('user_id'))->set($data)->update();
        return redirect()->to(base_url('/' . session()->get('checktype') . '/cluster_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แกไขข้อมูลสำเร็จแล้ว');
        //return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> รหัสผ่านปัจจุบันไม่ถูกต้อง');
        
    } else {
        return redirect()->to(base_url('/' . session()->get('checktype') . '/editprofile_cluster/'.$this->request->getVar('user_id')))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }

}

public function delmycluster_user($user_id)
{

    $clusterUsersModel = new ClustersUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    if(!empty($user_id)){

        $clusterUsersModel->delete($user_id);
        return redirect()->to(base_url('/' . session()->get('checktype') . '/cluster_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> ลบข้อมูลสำเร็จแล้ว');

    }else{

        return redirect()->to(base_url('/' . session()->get('checktype') . '/cluster_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> ไม่สามารถลบข้อมูลได้');

    }

}

public function upstatus_cluster()
{

    $clusterUsersModel = new ClustersUsersModel;

    $user_id= $this->request->getVar('my_checkbox_value');

    $User = $clusterUsersModel->where('user_id',$user_id)->first();

    if($User['user_status'] !="Active"){
        $data = [
            'user_status' => "Active"
        ];
        $up = $clusterUsersModel->where('user_id', $User['user_id'])->set($data)->update();
    
    } else {
        $data = [
            'user_status' => "ไม่อนุมัติ"
        ];
        $up = $clusterUsersModel->where('user_id', $User['user_id'])->set($data)->update();
    }

    if($up){
        return redirect()->to(base_url('/' . session()->get('checktype') . '/cluster_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แก้ไขข้อมูลสำเร็จแล้ว');
    }else{
        return redirect()->to(base_url('/' . session()->get('checktype') . '/cluster_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }

}

public function add_clusteruser()
{
    helper(['form']);
    $clustersModel = new ClustersModel;
    $clustersUsersModel = new ClustersUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;
    $prefixModel = new PrefixModel;

    $data = [
        'title' => [
        '1' => 'เพิ่มข้อมูลสมาชิกใหม่ '
        ],
        'cluster' => $clustersModel->findall(),
        'prefix' => $prefixModel->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/add_clusteruser', $data);

}

public function save_clusteruser()
{

    helper(['form']);
    $rules = [
        'user_clus' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'เขตตรวจราชการ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_prefix' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_fname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'ชื่อ ไม่สามารถเว้นว่างได้',
            'min_length' => 'ชื่อ อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'ชื่อ ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_lname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'นามสกุล ไม่สามารถเว้นว่างได้',
            'min_length' => 'นามสกุล อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'นามสกุล ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_email' => [
            'rules' => 'trim|required|valid_email',
            'errors' => [
            'required' => 'รูปแบบอีเมล์ไม่ถูกต้อง'
            ]
        ],
        'user_phone' => [
            'rules' => 'required|min_length[10]|max_length[20]',
            'errors' => [
            'required'   => 'หมายเลขโทรศัพท์ ไม่สามารถเว้นว่างได้',
            'min_length' => 'หมายเลขโทรศัพท์ ให้ใส่ 10 หลัก',
            'max_length' => 'หมายเลขโทรศัพท์ เกินจำนวน',
            ]
        ],
        'password' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'รหัสผ่านใหม่ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_role' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'สิทธิ์การใช้งาน ไม่สามารถเว้นว่างได้'
            ]
        ],
    ];

    if ($this->validate($rules)) {
        $clustersModel = new ClustersModel;
        $clusterUserModel = new ClustersUsersModel;

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();

            \Config\Services::image()
                ->withFile('uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('uploads/profile/' . $user_profile);

        } else {
            $user_profile = '';
        }
        $data = [
            'user_clus' => $this->request->getVar('user_clus'),
            'user_prefix' => $this->request->getVar('user_prefix'),
            'user_idcard' => $this->request->getVar('user_idcard'),
            'user_fname' => $this->request->getVar('user_fname'),
            'user_lname' => $this->request->getVar('user_lname'),
            'user_email' => $this->request->getVar('user_email'),
            'user_phone' => $this->request->getVar('user_phone'),
            'user_role' => $this->request->getVar('user_role'),
            'user_profile' => $user_profile,
            'user_password' => $this->request->getVar('password'),
            'user_hashpassword' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $clusterUserModel->save($data);
            return redirect()->to(base_url('/' . session()->get('checktype') . '/cluster_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เพิ่มข้อมูลสำเร็จแล้ว');
            
    } else {
    
            return redirect()->to(base_url('/' . session()->get('checktype') . '/cluster_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> เพิ่มข้อมูลไม่สำเร็จ');
    }

}


//////////////////// get_user

public function get_user()
{
    helper(['form']);
    $schoolsModel = new SchoolsModel;
    $areasModel = new AreasModel;
    $clustersModel = new ClustersModel;
    $usersModel = new UsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'รายการผู้ใช้งานโรงเรียน'
        ],
//        'cluster' => $clustersModel->findall(),
//        'area' => $areasModel->findall(),
//        'school' => $schoolsModel->findall(),
        'user' => $usersModel->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/get_user_ajax', $data);

}


public function Find_User_Ajax()
{
    $usersModel = new UsersModel;

    $params['draw'] = $_REQUEST['draw'];
    $start = $_REQUEST['start'];
    $length = $_REQUEST['length'];
    /* If we pass any extra data in request from ajax */
    //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";

    /* Value we will get from typing in search */
    $search_value = $_REQUEST['search']['value'];

    if(!empty($search_value)){
        // count all data
        $total_count = $usersModel->getUserAllSearch($search_value);
        // get per page data
        $data = $usersModel->getUserAllSearchLimit($start,$length,$search_value);
    }else{
        // count all data
        $total_count = $usersModel->getUserAll();
        // get per page data
        $data = $usersModel->getUserAllLimit($start,$length);
    }
    //$no = $_REQUEST['start'];
    $json_data = array(
        "draw" => intval($params['draw']),
        "recordsTotal" => count($total_count),
        "recordsFiltered" => count($total_count),
        "data" => $data   // total data array
    );

    echo json_encode($json_data);

}

public function getprofile_user($user_id)
{
    helper(['form']);
    $schoolsModel = new SchoolsModel;
    $areasModel = new AreasModel;
    $clustersModel = new ClustersModel;
    $usersModel = new UsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'ข้อมูลส่วนตัว '
        ],
        'cluster' => $clustersModel->findall(),
        'area' => $areasModel->findall(),
        'school' => $schoolsModel->findall(),
        'user' => $usersModel->where('user_id',$user_id)->first(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/getprofile_user', $data);

}

public function editprofile_user($user_id)
{
    helper(['form']);
    $schoolsModel = new SchoolsModel;
    $areasModel = new AreasModel;
    $clustersModel = new ClustersModel;
    $usersModel = new UsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;
    $prefixModel = new PrefixModel;
    $User = $usersModel->where('user_id',$user_id)->first();

    $data = [
        'title' => [
        '1' => 'แก้ไขข้อมูลส่วนตัว '
        ],
        'cluster' => $clustersModel->findall(),
        'area' => $areasModel->where('area_code',$User['user_area'])->findall(),
        'school' => $schoolsModel->where('sch_id',$User['sch_id'])->findall(),
        'prefix' => $prefixModel->findall(),
        'user' => $usersModel->where('user_id',$user_id)->first(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/editprofile_user', $data);
    
}

public function updateprofile_user(){		

    helper(['form']);
    $rules = [
        'user_clus' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'เขตตรวจราชการ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_area' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'เขตพื้นที่ฯ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_sch' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'โรงเรียน ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_prefix' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_fname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'ชื่อ ไม่สามารถเว้นว่างได้',
            'min_length' => 'ชื่อ อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'ชื่อ ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_lname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'นามสกุล ไม่สามารถเว้นว่างได้',
            'min_length' => 'นามสกุล อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'นามสกุล ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_email' => [
            'rules' => 'trim|required|valid_email',
            'errors' => [
            'required' => 'รูปแบบอีเมล์ไม่ถูกต้อง'
            ]
        ],
        'user_phone' => [
            'rules' => 'required|min_length[10]|max_length[20]',
            'errors' => [
            'required'   => 'หมายเลขโทรศัพท์ ไม่สามารถเว้นว่างได้',
            'min_length' => 'หมายเลขโทรศัพท์ ให้ใส่ 10 หลัก',
            'max_length' => 'หมายเลขโทรศัพท์ เกินจำนวน',
            ]
        ],
        'user_role' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'สิทธิ์การใช้งาน ไม่สามารถเว้นว่างได้'
            ]
        ],
    ];

    if ($this->validate($rules)) {

        $usersModel = new UsersModel;
        $adminOnlineModel = new AdminsOnlinesModel;

        $user_id = $this->request->getVar('user_id');

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();
            $data = [
                'user_profile' => $user_profile
            ];

            $file_old = $usersModel->where('user_id', $user_id)->first();

            if($file_old['user_profile'] != ""){
                @unlink('uploads/profile/' . $file_old['user_profile']);
            }

            if ($file->move('uploads/profile/', $user_profile)) {

            \Config\Services::image()
                ->withFile('uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('uploads/profile/' . $user_profile);

            }

            $usersModel->where('user_id', $user_id)->set($data)->update();
        }

        $data = [
            'user_clus' => $this->request->getVar('user_clus'),
            'user_area' => $this->request->getVar('user_area'),
            'sch_id' => $this->request->getVar('user_sch'),
            'user_prefix' => $this->request->getVar('user_prefix'),
            'user_fname' => $this->request->getVar('user_fname'),
            'user_lname' => $this->request->getVar('user_lname'),
            'user_email' => $this->request->getVar('user_email'),
            'user_phone' => $this->request->getVar('user_phone'),
            'user_role' => $this->request->getVar('user_role'),
            //'user_profile' => $user_profile,
        ];

        $usersModel->where('user_id', $this->request->getVar('user_id'))->set($data)->update();
        return redirect()->to(base_url('/' . session()->get('checktype') . '/get_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แกไขข้อมูลสำเร็จแล้ว');
        //return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> รหัสผ่านปัจจุบันไม่ถูกต้อง');
        
    } else {
        return redirect()->to(base_url('/' . session()->get('checktype') . '/editprofile_user/'.$this->request->getVar('user_id')))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }

}

public function delmy_user($user_id)
{
    $schoolsModel = new SchoolsModel;
    $usersModel = new UsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    if(!empty($user_id)){

        $usersModel->delete($user_id);
        return redirect()->to(base_url('/' . session()->get('checktype') . '/get_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> ลบข้อมูลสำเร็จแล้ว');

    }else{

        return redirect()->to(base_url('/' . session()->get('checktype') . '/get_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> ไม่สามารถลบข้อมูลได้');

    }

}

public function upstatus_user()
{

    $usersModel = new UsersModel;

    $user_id= $this->request->getVar('my_checkbox_value');

    $User = $usersModel->where('user_id',$user_id)->first();

    if($User['user_status'] !="Active"){
        $data = [
            'user_status' => "Active"
        ];
        $up = $usersModel->where('user_id', $User['user_id'])->set($data)->update();
    
    } else {
        $data = [
            'user_status' => "ไม่อนุมัติ"
        ];
        $up = $usersModel->where('user_id', $User['user_id'])->set($data)->update();
    }

    if($up){
        return redirect()->to(base_url('/' . session()->get('checktype') . '/get_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แก้ไขข้อมูลสำเร็จแล้ว');
    }else{
        return redirect()->to(base_url('/' . session()->get('checktype') . '/get_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }

}

public function add_user()
{
    helper(['form']);
    $schoolsModel = new SchoolsModel;
    $areasModel = new AreasModel;
    $clustersModel = new ClustersModel;
    $usersModel = new UsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;
    $prefixModel = new PrefixModel;

    $data = [
        'title' => [
        '1' => 'เพิ่มข้อมูลสมาชิกใหม่ '
        ],
        'cluster' => $clustersModel->findall(),
        'area' => $areasModel->findall(),
        'prefix' => $prefixModel->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/add_user', $data);

}

public function save_user()
{

    helper(['form']);
    $rules = [
        'user_clus' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'เขตตรวจราชการ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_area' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'เขตพื้นที่ฯ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_sch' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'โรงเรียน ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_prefix' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_fname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'ชื่อ ไม่สามารถเว้นว่างได้',
            'min_length' => 'ชื่อ อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'ชื่อ ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_lname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'นามสกุล ไม่สามารถเว้นว่างได้',
            'min_length' => 'นามสกุล อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'นามสกุล ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_email' => [
            'rules' => 'trim|required|valid_email',
            'errors' => [
            'required' => 'รูปแบบอีเมล์ไม่ถูกต้อง'
            ]
        ],
        'user_phone' => [
            'rules' => 'required|min_length[10]|max_length[20]',
            'errors' => [
            'required'   => 'หมายเลขโทรศัพท์ ไม่สามารถเว้นว่างได้',
            'min_length' => 'หมายเลขโทรศัพท์ ให้ใส่ 10 หลัก',
            'max_length' => 'หมายเลขโทรศัพท์ เกินจำนวน',
            ]
        ],
        'password' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'รหัสผ่านใหม่ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_role' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'สิทธิ์การใช้งาน ไม่สามารถเว้นว่างได้'
            ]
        ],
    ];

    if ($this->validate($rules)) {
        $areasModel = new AreasModel;
        $clustersModel = new ClustersModel;
        $usersModel = new UsersModel;

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();

            \Config\Services::image()
                ->withFile('uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('uploads/profile/' . $user_profile);

        } else {
            $user_profile = '';
        }
        $data = [
            'user_clus' => $this->request->getVar('user_clus'),
            'user_area' => $this->request->getVar('user_area'),
            'sch_id' => $this->request->getVar('user_sch'),
            'user_prefix' => $this->request->getVar('user_prefix'),
            'user_idcard' => $this->request->getVar('user_idcard'),
            'user_fname' => $this->request->getVar('user_fname'),
            'user_lname' => $this->request->getVar('user_lname'),
            'user_email' => $this->request->getVar('user_email'),
            'user_phone' => $this->request->getVar('user_phone'),
            'user_role' => $this->request->getVar('user_role'),
            'user_profile' => $user_profile,
            'user_password' => $this->request->getVar('password'),
            'user_hashpassword' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $usersModel->save($data);
            return redirect()->to(base_url('/' . session()->get('checktype') . '/get_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เพิ่มข้อมูลสำเร็จแล้ว');
            
    } else {
    
            return redirect()->to(base_url('/' . session()->get('checktype') . '/get_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> เพิ่มข้อมูลไม่สำเร็จ');
    }

}


//////////////////// super_user

public function super_user()
{
    helper(['form']);
    $supersUsersModel = new SupersUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'รายการกรรมการประเมิน'
        ],
        'user' => $supersUsersModel->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/super_user', $data);

}

public function getprofile_super($user_id)
{
    helper(['form']);
    $supersUsersModel = new SupersUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    $data = [
        'title' => [
        '1' => 'ข้อมูลส่วนตัว '
        ],
        'user' => $supersUsersModel->where('user_id',$user_id)->first(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/getprofile_super', $data);

}

public function editprofile_super($user_id)
{
    helper(['form']);
    $supersUsersModel = new SupersUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;
    $prefixModel = new PrefixModel;

    $data = [
        'title' => [
        '1' => 'แก้ไขข้อมูลส่วนตัว '
        ],
        'prefix' => $prefixModel->findall(),
        'user' => $supersUsersModel->where('user_id',$user_id)->first(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/editprofile_super', $data);
    
}

public function updateprofile_super(){		

    helper(['form']);
    $rules = [
        'user_prefix' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_fname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'ชื่อ ไม่สามารถเว้นว่างได้',
            'min_length' => 'ชื่อ อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'ชื่อ ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_lname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'นามสกุล ไม่สามารถเว้นว่างได้',
            'min_length' => 'นามสกุล อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'นามสกุล ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_email' => [
            'rules' => 'trim|required|valid_email',
            'errors' => [
            'required' => 'รูปแบบอีเมล์ไม่ถูกต้อง'
            ]
        ],
        'user_phone' => [
            'rules' => 'required|min_length[10]|max_length[20]',
            'errors' => [
            'required'   => 'หมายเลขโทรศัพท์ ไม่สามารถเว้นว่างได้',
            'min_length' => 'หมายเลขโทรศัพท์ ให้ใส่ 10 หลัก',
            'max_length' => 'หมายเลขโทรศัพท์ เกินจำนวน',
            ]
        ],
    ];

    if ($this->validate($rules)) {

        $superUserModel = new SupersUsersModel;
        $adminOnlineModel = new AdminsOnlinesModel;

        $user_id = $this->request->getVar('user_id');

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();
            $data = [
                'user_profile' => $user_profile
            ];

            $file_old = $superUserModel->where('user_id', $user_id)->first();

            if($file_old['user_profile'] != ""){
                @unlink('uploads/profile/' . $file_old['user_profile']);
            }

            if ($file->move('uploads/profile/', $user_profile)) {

            \Config\Services::image()
                ->withFile('uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('uploads/profile/' . $user_profile);

            }

            $superUserModel->where('user_id', $user_id)->set($data)->update();
        }

        $data = [
            'user_prefix' => $this->request->getVar('user_prefix'),
            'user_fname' => $this->request->getVar('user_fname'),
            'user_lname' => $this->request->getVar('user_lname'),
            'user_email' => $this->request->getVar('user_email'),
            'user_phone' => $this->request->getVar('user_phone'),
            //'user_profile' => $user_profile,
        ];

        $superUserModel->where('user_id', $this->request->getVar('user_id'))->set($data)->update();
        return redirect()->to(base_url('/' . session()->get('checktype') . '/super_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แกไขข้อมูลสำเร็จแล้ว');
        //return redirect()->to(base_url('/' . session()->get('checktype') . '/list_year'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> รหัสผ่านปัจจุบันไม่ถูกต้อง');
        
    } else {
        return redirect()->to(base_url('/' . session()->get('checktype') . '/editprofile_super/'.$this->request->getVar('user_id')))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }

}

public function delmysuper_user($user_id)
{

    $superUsersModel = new SupersUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;

    if(!empty($user_id)){

        $superUsersModel->delete($user_id);
        return redirect()->to(base_url('/' . session()->get('checktype') . '/super_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> ลบข้อมูลสำเร็จแล้ว');

    }else{

        return redirect()->to(base_url('/' . session()->get('checktype') . '/super_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> ไม่สามารถลบข้อมูลได้');

    }

}

public function upstatus_super()
{

    $superUsersModel = new SupersUsersModel;

    $user_id= $this->request->getVar('my_checkbox_value');

    $User = $superUsersModel->where('user_id',$user_id)->first();

    if($User['user_status'] !="Active"){
        $data = [
            'user_status' => "Active"
        ];
        $up = $superUsersModel->where('user_id', $User['user_id'])->set($data)->update();
    
    } else {
        $data = [
            'user_status' => "ไม่อนุมัติ"
        ];
        $up = $superUsersModel->where('user_id', $User['user_id'])->set($data)->update();
    }

    if($up){
        return redirect()->to(base_url('/' . session()->get('checktype') . '/super_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> แก้ไขข้อมูลสำเร็จแล้ว');
    }else{
        return redirect()->to(base_url('/' . session()->get('checktype') . '/super_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> แก้ไขข้อมูลไม่สำเร็จ');
    }

}

public function add_superuser()
{
    helper(['form']);
    $supersUsersModel = new SupersUsersModel;
    $adminOnlineModel = new AdminsOnlinesModel;
    $prefixModel = new PrefixModel;

    $data = [
        'title' => [
        '1' => 'เพิ่มข้อมูลสมาชิกใหม่ '
        ],
        'prefix' => $prefixModel->findall(),
        'useronline' => $adminOnlineModel->where('checktype','dis')->countAllResults(),    
    ];

    echo view(session()->get('checktype').'/add_superuser', $data);

}

public function save_superuser()
{

    helper(['form']);
    $rules = [
        'user_prefix' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_fname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'ชื่อ ไม่สามารถเว้นว่างได้',
            'min_length' => 'ชื่อ อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'ชื่อ ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_lname' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
            'required' => 'นามสกุล ไม่สามารถเว้นว่างได้',
            'min_length' => 'นามสกุล อย่างน้อย 2 ตัวอักษร',
            'max_length' => 'นามสกุล ใส่มากสุดได้ 50 ตัวอักษร',
            ]
        ],
        'user_email' => [
            'rules' => 'trim|required|valid_email',
            'errors' => [
            'required' => 'รูปแบบอีเมล์ไม่ถูกต้อง'
            ]
        ],
        'user_phone' => [
            'rules' => 'required|min_length[10]|max_length[20]',
            'errors' => [
            'required'   => 'หมายเลขโทรศัพท์ ไม่สามารถเว้นว่างได้',
            'min_length' => 'หมายเลขโทรศัพท์ ให้ใส่ 10 หลัก',
            'max_length' => 'หมายเลขโทรศัพท์ เกินจำนวน',
            ]
        ],
        'password' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'รหัสผ่านใหม่ ไม่สามารถเว้นว่างได้'
            ]
        ],
    ];

    if ($this->validate($rules)) {

        $superUserModel = new SupersUsersModel;

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();

            \Config\Services::image()
                ->withFile('uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('uploads/profile/' . $user_profile);

        } else {
            $user_profile = '';
        }
        $data = [
            'user_prefix' => $this->request->getVar('user_prefix'),
            'user_idcard' => $this->request->getVar('user_idcard'),
            'user_fname' => $this->request->getVar('user_fname'),
            'user_lname' => $this->request->getVar('user_lname'),
            'user_email' => $this->request->getVar('user_email'),
            'user_phone' => $this->request->getVar('user_phone'),
            'user_profile' => $user_profile,
            'user_password' => $this->request->getVar('password'),
            'user_hashpassword' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $superUserModel->save($data);
            return redirect()->to(base_url('/' . session()->get('checktype') . '/super_user'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เพิ่มข้อมูลสำเร็จแล้ว');
            
    } else {
    
            return redirect()->to(base_url('/' . session()->get('checktype') . '/super_user'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> เพิ่มข้อมูลไม่สำเร็จ');
    }

}





}