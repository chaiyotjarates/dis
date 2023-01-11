<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface; 

use App\Models\UsersModel;
use App\Models\AwardsModel;
use App\Models\PrefixModel;
use App\Models\AreasModel;
use App\Models\SchoolsModel;
use App\Models\ClustersModel;
use App\Models\KurusConfigsModel;
use App\Models\UsersOnlinesModel;

use \Hermawan\DataTables\DataTable;

class SchoolController extends Controller {

function __construct(){

    helper(['functions']);

}
	
public function index() {

    //helper(['functions']);

    $userModel = new UsersModel;
    $awardModel = new AwardsModel;
    $areaModel = new AreasModel;
    $clusterModel = new ClustersModel;
    $kuruConfigModel = new KurusConfigsModel;
    $userOnlineModel = new UsersOnlinesModel;

    $data = [
        'title' => [
            //'1' => 'Dashboard ผู้ใช้งานโรงเรียน,'.session()->get('fullname')
            '1' => 'Dashboard ผู้ใช้งานโรงเรียน',
        ],
        'teacher' => $userModel->where('sch_id',session()->get('school'))->where('user_role', 'teacher')->countAllResults(),
        'confirm' => $userModel->where('sch_id',session()->get('school'))->where('user_status', 'waiting')->countAllResults(),
        'award' => $awardModel->where('sch_id',session()->get('school'))->countAllResults(),
        'awardall' => $awardModel->countAllResults(),
        'config' => $kuruConfigModel->where('co_status', 'Active')->first(),
        'DateNow' => date("Y-m-d"),
        'useronline' => $userOnlineModel->where('checktype','kuru')->countAllResults(),
    ];

    echo view('school/dashboard', $data); 
 
}

public function changePassword()
{

    helper(['form']);
    $userModel = new UsersModel;
    $userOnlineModel = new UsersOnlinesModel;

    $data = [
        'title' => [
        '1' => 'เปลี่ยนรหัสผ่าน'
        ],
        'user' => $userModel->where('user_id',session()->get('user_id'))->first(),
        'useronline' => $userOnlineModel->where('checktype','kuru')->countAllResults(),    
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

        $usermodel = new UsersModel();
        $userOnlineModel = new UsersOnlinesModel;

        $chkPassword = $usermodel->changePassword($this->request->getVar('old_password'), session()->get('user_id'));

        if ($chkPassword) {
            $data = [
            'user_password' => $this->request->getVar('new_password'),
            'user_hashpassword' => password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT),
            ];
            $usermodel->where('user_id', session()->get('user_id'))->set($data)->update();
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
            'validation' => $this->validator
        ];
        echo view(session()->get('checktype').'/changePassword', $data);

    }
}

public function profile()
{
    $userModel = new UsersModel();
    $prefixModel = new PrefixModel();
    $areaModel = new AreasModel();
    $schoolsModel = new SchoolsModel;
    $areaModel = new AreasModel;
    $clusterModel = new ClustersModel;
    $userOnlineModel = new UsersOnlinesModel;

    helper(['form']);

    $data = [
        'title' => [
        '1' => 'แก้ไขข้อมูลส่วนตัว'
        ],
        'user' => $userModel->where('user_id', session()->get('user_id'))->first(),
        'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
        'area' => $areaModel->orderBy('area_id', 'asc')->findall(),
        'cluster' => $clusterModel->orderBy('clus_id', 'asc')->findall(),        
        'school' => $schoolsModel->where('sch_area', session()->get('area'))->orderBy('sch_id', 'asc')->findall(),
        'useronline' => $userOnlineModel->where('checktype','kuru')->countAllResults(),
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
    'clus_code'  => array(
        'rules'  => 'required',
        'errors' => array(
        'required'   => 'เขตตรวจราชการ ไม่สามารถเว้นว่างได้'
        ),
    ),
    'area_code'  => array(
        'rules'  => 'required',
        'errors' => array(
        'required'   => 'เขตพื้นที่ฯ ไม่สามารถเว้นว่างได้'
        ),
    ),
    'sch_code'  => array(
        'rules'  => 'required',
        'errors' => array(
        'required'   => 'โรงเรียน ไม่สามารถเว้นว่างได้'
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
    )
    );

    if ($this->validate($rules)) {

        $userModel = new UsersModel;

        $user_id = session()->get('user_id');

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();
            $data = [
                'user_profile' => $user_profile
            ];

            $file_old = $userModel->where('user_id', $user_id)->first();

            if($file_old['user_profile'] != ""){
                @unlink('../../uploads/profile/' . $file_old['user_profile']);
            }

            if ($file->move('../../uploads/profile/', $user_profile)) {

            \Config\Services::image()
                ->withFile('../../uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('../../uploads/profile/' . $user_profile);

            }

            $userModel->where('user_id', $user_id)->set($data)->update();

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
            'user_clus'     => $this->request->getVar('clus_code'),
            'user_area'     => $this->request->getVar('area_code'),
            'sch_id'    => $this->request->getVar('sch_code'),
            'user_email'   => $this->request->getVar('user_email'),
            'user_phone'   => $this->request->getVar('user_phone'),
            'imgProfile' => $user_profile
        );

        $remove_data = [
            'prefix',
            'firstname',
            'lastname',
            'fullname',
            'email',
            'area',
            'cluster',
        ];
        session()->remove($remove_data);
        
        $ses_data = [
            //'imgProfile' => $user_profile,
            'prefix' => $this->request->getVar('user_prefix'),
            'firstname' => $this->request->getVar('user_fname'),
            'lastname' => $this->request->getVar('user_lname'),
            'fullname' => $this->request->getVar('user_prefix').$this->request->getVar('user_fname').' '.$this->request->getVar('user_lname'),
            'email' => $this->request->getVar('user_email'),
            'area' => $this->request->getVar('area_code'),
            'cluster' => $this->request->getVar('clus_code'), 
            'imgProfile' => $user_profile
           
        ];
        session()->set($ses_data);

        $userModel->update($user_id, $data);

        return redirect()->to(base_url(session()->get('checktype').'/profile'))->with('success', '<i class="far fa-check-circle fs-16"></i> ปรับปรุงข้อมูลส่วนตัวสำเร็จ');

    } else {

        helper(array('form'));

        $userModel = new UsersModel();
        $prefixModel = new PrefixModel();
        $areaModel = new AreasModel();
        $schoolsModel = new SchoolsModel;
        $clustersModel = new ClustersModel;

        helper(['form']);

        $data = [
            'title' => [
                '1' => 'แก้ไขข้อมูลส่วนตัว'
            ],
            'validation' => $this->validator,
            'user' => $userModel->where('user_id', session()->get('user_id'))->first(),
            'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
            'area' => $areaModel->orderBy('area_id', 'asc')->findall(),
            'cluster' => $clustersModel->orderBy('clus_id', 'asc')->findall(), 
            'school' => $schoolsModel->where('sch_area', session()->get('area'))->orderBy('sch_id', 'asc')->findall()
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

public function amphurSearch()
{
    $amphurModel = new AmphursModel;
    $code = json_decode($_POST["code"]);
    $data = $amphurModel->where('provinceID', $code)->findall();

    echo json_encode($data);
}

public function tumbonSearch()
{
    $tumbonModel = new TumbonsModel;
    $code = json_decode($_POST["code"]);
    $data = $tumbonModel->where('amphurID', $code)->findall();

    echo json_encode($data);
}

public function users()
{
    $userOnlineModel = new UsersOnlinesModel;

    $data = [
    'title' => [
        '1' => 'สมาชิกของโรงเรียน'
    ],
    'useronline' => $userOnlineModel->where('checktype','kuru')->countAllResults(),

    ];
    echo view(session()->get('checktype').'/users', $data);

}

public function addUser()
{

    $userModel = new UsersModel();
    $prefixModel = new PrefixModel();
    $areaModel = new AreasModel();
    $clusterModel = new ClustersModel();
    $schoolsModel = new SchoolsModel;
    $userOnlineModel = new UsersOnlinesModel;

    helper(['form']);
    $data = [
        'title' => [
            '1' => 'เพิ่มสมาชิกใหม่ของโรงเรียน'
        ],
        'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
        'area' => $areaModel->orderBy('area_id', 'asc')->findall(),
        'cluster' => $clustersModel->orderBy('area_id', 'asc')->findall(),
        'school' => $schoolModel->where('sch_area', session()->get('area'))->orderBy('sch_id', 'asc')->findall(),
        'useronline' => $userOnlineModel->where('checktype','kuru')->countAllResults(),

    ];
    echo view(session()->get('checktype').'/addUser', $data);

}

public function insertUser()
{
    helper(array('form'));
    $rules = array(
        'user_idcard' => array(
            'rules'  => 'required|min_length[13]|max_length[13]|is_unique[user.user_idcard]',
            'errors' => array(
            'required'   => 'เลขบัตร ปชช. ไม่สามารถเว้นว่างได้',
            'min_length' => 'เลขบัตร ปชช. มี 13 หลัก',
            'max_length' => 'เลขบัตร ปชช. มี 13 หลัก',
            'is_unique' => 'มีเลขบัตร ปชช. นี้ในระบบแล้ว'
            ),
        ),
        'user_prefix'    => array(
            'rules'  => 'required',
            'errors' => array(
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้',
            ),
        ),
        'user_fname' => array(
            'rules'  => 'required',
            'errors' => array(
            'required'   => 'ชื่อ ไม่สามารถเว้นว่างได้'
            ),
        ),
        'user_lname'  => array(
            'rules'  => 'required',
            'errors' => array(
            'required'   => 'นามสกุล ไม่สามารถเว้นว่างได้'
            ),
        ),
        'sch_code'  => array(
            'rules'  => 'required',
            'errors' => array(
            'required'   => 'โรงเรียน ไม่สามารถเว้นว่างได้'
            ),
        ),
        'user_password'     => array(
            'rules'  => 'required',
            'errors' => array(
            'required'   => 'รหัสผ่าน ไม่สามารถเว้นว่างได้'
            ),
        )
    );

    if ($this->validate($rules)) {

        $userModel = new UsersModel;
        $userOnlineModel = new UsersOnlinesModel;

        $user_id = session()->get('user_id');

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();

            if($file->move('../../uploads/profile/', $user_profile)) {

            \Config\Services::image()
                ->withFile('../../uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('../../uploads/profile/' . $user_profile);

            }

        }

        $data = array(
            'user_prefix'    => $this->request->getVar('user_prefix'),
            'user_fname' => $this->request->getVar('user_fname'),
            'user_lname'  => $this->request->getVar('user_lname'),
            'user_idcard'     => $this->request->getVar('user_idcard'),
            'sch_id'    => $this->request->getVar('sch_code'),
            'user_role'    => 'teacher',
            'user_password'  => $this->request->getVar('user_password'),
            'user_hashpassword'  => password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT),
            'user_dateregis' => date("Y-m-d H:i:s"),
            'user_clus' => session()->get('cluster'),
            'user_area' => session()->get('area'),
            'user_status' => 'Active',
            'user_profile' => $user_profile,
            'user_phone'     => $this->request->getVar('user_phone'),
            'user_email'     => $this->request->getVar('user_email'),
            'user_address'     => $this->request->getVar('user_address'),
            'user_tumbon'     => $this->request->getVar('user_tumbon'),
            'user_amp'     => $this->request->getVar('user_amp'),
            'user_prov'     => $this->request->getVar('user_prov'),
            'user_post'     => $this->request->getVar('user_post'),
            'user_LineId'     => $this->request->getVar('user_LineId'),
            'user_facebook'     => $this->request->getVar('user_facebook'),
            'user_twitter'     => $this->request->getVar('user_twitter'),
            'user_tiktok'     => $this->request->getVar('user_tiktok'),
            'user_IG'     => $this->request->getVar('user_IG'),
        );

        $userModel->insert($data);

        return redirect()->to(base_url(session()->get('checktype').'/users'))->with('success', '<i class="far fa-check-circle fs-16"></i> เพิ่มสมาชิกใหม่สำเร็จ');
 
    } else {

        $userModel = new UsersModel();
        $prefixModel = new PrefixModel();
        $areaModel = new AreasModel();
        $clusterModel = new ClustersModel();
        $schoolsModel = new SchoolsModel;
        $userOnlineModel = new UsersOnlinesModel;

        helper(['form']);

        $data = [
            'title' => [
                '1' => 'เพิ่มสมาชิกใหม่ของโรงเรียน'
            ],
            'validation' => $this->validator,
            'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
            'area' => $areaModel->orderBy('area_id', 'asc')->findall(),
            'cluster' => $clusterModel->orderBy('clus_id', 'asc')->findall(),
            'school' => $schoolsModel->where('sch_area', session()->get('area'))->orderBy('sch_id', 'asc')->findall(),
            'useronline' => $userOnlineModel->where('checktype','kuru')->countAllResults(),

        ];

        echo view(session()->get('checktype').'/addUser', $data);

    }
}

public function confirmUser()
{
    $userOnlineModel = new UsersOnlinesModel;

    $data = [
    'title' => [
        '1' => 'ยืนยันสมาชิกใหม่ของโรงเรียน'
    ],
    'useronline' => $userOnlineModel->where('checktype','kuru')->countAllResults(),

    ];
    echo view(session()->get('checktype').'/confirmUser', $data);
    
}

public function listTeachersData()
{
    $userModel = new UsersModel();
    $userOnlineModel = new UsersOnlinesModel;

    $builder = $userModel->select("user_id, CONCAT(user_prefix,user_fname, ' ', user_lname) AS name, sch_name")
   // ->where(['user.sch_id' => session()->get('school'), 'user.user_id !=' => session()->get('user_id'), 'user.user_role' => 'teacher'])
    ->where(['user.user_area' => session()->get('area')])
    ->join('school', 'school.sch_id = user.sch_id');
    
    return DataTable::of($builder)
    ->add('action', function($row){
        return '<a class="btn btn-primary btn-sm" href="'.base_url(session()->get('checktype').'/editUser/'.$row->user_id).'" ><i class="fas fa-user-edit"></i></a>';
    }, 'last')
    ->toJson();
}
 
}   