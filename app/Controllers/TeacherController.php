<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface; 

use App\Models\UsersModel;
use App\Models\PrefixModel;
use App\Models\AreasModel;
use App\Models\SchoolsModel;
use App\Models\ProvincesModel;
use App\Models\AmphursModel;
use App\Models\TumbonsModel;
use App\Models\AwardsModel;

use \Hermawan\DataTables\DataTable;

class TeacherController extends Controller {

public function index() {

    $awardModel = new AwardsModel;
    $award = $awardModel->where('kuru_award.user_id', session()->get('id'))->countAllResults();
    
    if($award == 0){

        helper(['form']);
        $data = [
        'title' => [
            '1' => 'ส่งผลงาน'
        ]
        ];
        echo view(session()->get('role').'/sendAward', $data);

    }elseif($award == 1){
        
        $awardModel = new AwardsModel;
        $award = $awardModel->where('kuru_award.user_id', session()->get('id'))
                            ->join('user', 'user.user_id = kuru_award.user_id')
                            ->first();

        helper(['form']);
        $data = [
            'title' => [
                '1' => 'สถานะการผลงาน'
            ],
            'award' => $award
        ];
        return redirect()->to(base_url(session()->get('role').'/status-award'))->with('success', '<i class="far fa-check-circle fs-16"></i> ท่านได้ส่งผลงานแล้ว สามารถตรวจสอบสถานะได้ที่รายละเอียดด้านล่างนี้');
        
    }else{
        echo view(session()->get('role'));
    } 

}

public function sendAward()
{
    $awardModel = new AwardsModel;
    $award = $awardModel->where('kuru_award.user_id', session()->get('id'))->countAllResults();
    
    if($award == 0){

        helper(['form']);
        $data = [
        'title' => [
            '1' => 'ส่งผลงาน'
        ]
        ];
        echo view(session()->get('role').'/sendAward', $data);

    }elseif($award == 1){
        
        $awardModel = new AwardsModel;
        $award = $awardModel->where('kuru_award.user_id', session()->get('id'))
                            ->join('user', 'user.user_id = kuru_award.user_id')
                            ->first();

        helper(['form']);
        $data = [
            'title' => [
                '1' => 'สถานะการผลงาน'
            ],
            'award' => $award
        ];
        return redirect()->to(base_url(session()->get('role').'/status-award'))->with('success', '<i class="far fa-check-circle fs-16"></i> ท่านได้ส่งผลงานแล้ว สามารถตรวจสอบสถานะได้ที่รายละเอียดด้านล่างนี้');
        
    }else{
        echo view(session()->get('role'));
    }

}

public function cancelAward()
{
    $awardModel = new AwardsModel;
    $award = $awardModel->where('user_id', session()->get('id'))->delete();
    helper(['form']);
    $data = [
        'title' => [
            '1' => 'ส่งผลงาน'
        ]
    ];
    return redirect()->to(base_url(session()->get('role').'/sendAward'))->with('success', '<i class="far fa-check-circle fs-16"></i> ท่านได้ยกเลิกการส่งผลงานแล้ว');
    
}

public function insertAward()
{
    helper(array('form'));
    $rules = array(
        'url'    => array(
            'rules'  => 'required',
            'errors' => array(
            'required' => 'Url ไม่สามารถเว้นว่างได้',
            ),
        )
    );

    if ($this->validate($rules)) {

        $awardModel = new AwardsModel;

        $data = array(
            'user_id'    => session()->get('id'),
            'status' => 'waiting',
            'datetime'  => date('Y-m-d H:i:s'),
            'url'     => $this->request->getVar('url')
        );

        $awardModel->insert($data);

        return redirect()->to(base_url(session()->get('role').'/status-award'))->with('success', '<i class="far fa-check-circle fs-16"></i> ท่านได้ส่งผลงานสำเร็จแล้ว รอการตรวจสอบจากกรรมการ');
 
    } else {

        helper(['form']);

        $data = [
            'title' => [
                '1' => 'ส่งผลงาน'
            ],
            'validation' => $this->validator
        ];

        echo view(session()->get('role').'/sendAward', $data);

    }
}

public function status_award()
{

    $awardModel = new AwardsModel;
    $award = $awardModel->where('kuru_award.user_id', session()->get('id'))
                        ->join('user', 'user.user_id = kuru_award.user_id')
                        ->first();

    if($award){
        helper(['form']);
        $data = [
            'title' => [
                '1' => 'สถานะการผลงาน'
            ],
            'award' => $award
        ];
        echo view(session()->get('role').'/status_award', $data);
    }else{
        helper(['form']);
        $data = [
        'title' => [
            '1' => 'ส่งผลงาน'
        ]
        ];
        return redirect()->to(base_url(session()->get('role').'/sendAward'))->with('error', '<i class="far fa-exclamation-triangle"></i> ท่านยังไม่ได้ส่งผลงาน จึงไม่สามารถตรวจสอบสถานะได้');
    }

    
}

public function changePassword()
{

    helper(['form']);
    $data = [
    'title' => [
        '1' => 'เปลี่ยนรหัสผ่าน'
    ]
    ];
    echo view(session()->get('role').'/changePassword', $data);
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

        $chkPassword = $usermodel->changePassword($this->request->getVar('old_password'), session()->get('id'));

        if ($chkPassword) {
            $data = [
            'user_password' => $this->request->getVar('new_password'),
            'user_hashpassword' => password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT),
            ];
            $usermodel->where('user_id', session()->get('id'))->set($data)->update();
            return redirect()->to(base_url('/' . session()->get('role') . '/changePassword'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เปลี่ยนรหัสผ่านสำเร็จแล้ว');
        } else {
            return redirect()->to(base_url('/' . session()->get('role') . '/changePassword'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> รหัสผ่านปัจจุบันไม่ถูกต้อง');
        }
    } else {

        helper(['form']);
        $data = [
            'title' => [
            '1' => 'เปลี่ยนรหัสผ่าน',
            ],
            'validation' => $this->validator
        ];
        echo view(session()->get('role').'/changePassword', $data);

    }
}

public function profile()
{
    $usermodel = new UsersModel();
    $prefixmodel = new PrefixModel();
    $areamodel = new AreasModel();
    $provincemodel = new ProvincesModel();
    $amphurmodel = new AmphursModel();
    $tumbonmodel = new TumbonsModel();
    $schoolsModel = new SchoolsModel;

    helper(['form']);

    $data = [
        'title' => [
        '1' => 'แก้ไขข้อมูลส่วนตัว'
        ],
        'user' => $usermodel->where('user_id', session()->get('id'))->first(),
        'prefix' => $prefixmodel->orderBy('prefix_id', 'asc')->findall(),
        'area' => $areamodel->orderBy('area_id', 'asc')->findall(),
        'prov' => $provincemodel->orderBy('id', 'asc')->findall(),
        'amp' => $amphurmodel->where('provinceID', session()->get('province'))->orderBy('id', 'asc')->findall(),
        'tumbon' => $tumbonmodel->where('amphurID', session()->get('amphur'))->orderBy('id', 'asc')->findall(),
        'school' => $schoolsModel->where('sch_area', session()->get('area'))->orderBy('sch_id', 'asc')->findall()
    ];
    echo view(session()->get('role').'/profile', $data);
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
    'sch_code'  => array(
        'rules'  => 'required',
        'errors' => array(
        'required'   => 'โรงเรียน ไม่สามารถเว้นว่างได้'
        ),
    ),
    'user_address'  => array(
        'rules'  => 'required',
        'errors' => array(
        'required'   => 'ที่อยู่ ไม่สามารถเว้นว่างได้'
        ),
    ),
    'user_prov'  => array(
        'rules'  => 'required',
        'errors' => array(
        'required'   => 'จังหวัด ไม่สามารถเว้นว่างได้'
        ),
    ),
    'user_amp'  => array(
        'rules'  => 'required',
        'errors' => array(
        'required'   => 'อำเภอ ไม่สามารถเว้นว่างได้'
        ),
    ),
    'user_tumbon'  => array(
        'rules'  => 'required',
        'errors' => array(
        'required'   => 'ตำบล ไม่สามารถเว้นว่างได้'
        ),
    ),
    'user_post'  => array(
        'rules'  => 'required',
        'errors' => array(
        'required'   => 'รหัสไปรษณีย์ ไม่สามารถเว้นว่างได้'
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
        $schoolModel = new SchoolsModel;

        $user_id = session()->get('id');

        if ($this->request->getFile('user_profile') != '') {
            $file = $this->request->getFile('user_profile');
            $user_profile = $file->getRandomName();
            $data = [
                'imgProfile' => $user_profile
            ];

            $file_old = $userModel->where('user_id', $user_id)->first();

            if($file_old['user_profile'] != ""){
                @unlink('uploads/profile/' . $file_old['user_profile']);
            }

            if ($file->move('uploads/profile/', $user_profile)) {

            \Config\Services::image()
                ->withFile('uploads/profile/' . $user_profile)
                ->fit(200, 200, 'center')
                ->save('uploads/profile/' . $user_profile);

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
            'sch_id'    => $this->request->getVar('sch_code'),
            'user_address'  => $this->request->getVar('user_address'),
            'user_prov' => $this->request->getVar('user_prov'),
            'user_amp'  => $this->request->getVar('user_amp'),
            'user_tumbon'   => $this->request->getVar('user_tumbon'),
            'user_post'   => $this->request->getVar('user_post'),
            'user_email'   => $this->request->getVar('user_email'),
            'user_phone'   => $this->request->getVar('user_phone'),
            'user_LineId'   => $this->request->getVar('user_LineId'),
            'user_facebook'   => $this->request->getVar('user_facebook'),
            'user_twitter'   => $this->request->getVar('user_twitter'),
            'user_IG'   => $this->request->getVar('user_IG')
        );

        $remove_data = [
            'prefix',
            'firstname',
            'lastname',
            'fullname',
            'email',
            'province',
            'amphur',
            'tumbon',
        ];
        session()->remove($remove_data);

        $schoolname = $schoolModel->where('sch_id', $this->request->getVar('sch_code'))->first();

        $ses_data = [
            'prefix' => $this->request->getVar('user_prefix'),
            'firstname' => $this->request->getVar('user_fname'),
            'lastname' => $this->request->getVar('user_lname'),
            'fullname' => $this->request->getVar('user_prefix').$this->request->getVar('user_fname').' '.$this->request->getVar('user_lname'),
            'email' => $this->request->getVar('user_email'),
            'province' => $this->request->getVar('user_prov'),
            'amphur' => $this->request->getVar('user_amp'),
            'tumbon' => $this->request->getVar('user_tumbon'),
            'school' => $this->request->getVar('sch_code'),
            'schoolName' => $schoolname['sch_name'],
            'schoolCode' => $schoolname['sch_code']
        ];
        session()->set($ses_data);

        $userModel->update($user_id, $data);

        return redirect()->to(base_url(session()->get('role').'/profile'))->with('success', '<i class="far fa-check-circle fs-16"></i> ปรับปรุงข้อมูลส่วนตัวสำเร็จ');

    } else {

        helper(array('form'));

        $usermodel = new UsersModel();
        $prefixmodel = new PrefixModel();
        $areamodel = new AreasModel();
        $provincemodel = new ProvincesModel();
        $amphurmodel = new AmphursModel();
        $tumbonmodel = new TumbonsModel();
        $schoolsModel = new SchoolsModel;

        helper(['form']);

        $data = [
            'title' => [
                '1' => 'แก้ไขข้อมูลส่วนตัว'
            ],
            'validation' => $this->validator,
            'user' => $usermodel->where('user_id', session()->get('id'))->first(),
            'prefix' => $prefixmodel->orderBy('prefix_id', 'asc')->findall(),
            'area' => $areamodel->orderBy('area_id', 'asc')->findall(),
            'prov' => $provincemodel->orderBy('id', 'asc')->findall(),
            'amp' => $amphurmodel->orderBy('id', 'asc')->findall(),
            'tumbon' => $tumbonmodel->orderBy('id', 'asc')->findall(),
            'school' => $schoolsModel->where('sch_area', session()->get('area'))->orderBy('sch_id', 'asc')->findall()
        ];

        echo view(session()->get('role').'/profile', $data);

    }
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
 
}
        