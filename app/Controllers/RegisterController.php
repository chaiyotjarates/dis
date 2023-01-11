<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\SchoolsModel;
use App\Models\AreasModel;
use App\Models\ClustersModel;
use App\Models\prefixModel;
use App\Models\AdminsUsersModel;
use App\Models\AreasUsersModel;
use App\Models\ClustersUsersModel;

use CodeIgniter\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class RegisterController extends Controller {

    public function RegSchool() {

        helper(['form']);
        $session = session(); 
        $userModel = new UsersModel;
        $schoolModel = new SchoolsModel;
        $areaModel = new AreasModel;
        $clusterModel = new ClustersModel;
        $prefixModel = new prefixModel;
        $areaModel = new AreasModel;
        $adminuserModel = new AdminsUsersModel;
        $areauserModel = new AreasUsersModel;
        $clusteruserModel = new ClustersUsersModel;

        if($session->get('checktype') != "school" or isset($session)){
            
            $data = [
                'title' => [
                    '1' => 'ลงทะเบียนสำหรับโรงเรียน',
                ],
                'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
                'area' => $areaModel->orderBy('area_id', 'asc')->findall(),
                'school' => $schoolModel->orderBy('sch_id', 'asc')->findall(),
                'cluster' => $clusterModel->orderBy('clus_id', 'asc')->findall(),
            ];
            echo view('frontend/registerSchool', $data);
        }else{
            //$session->setFlashdata('msg', 'ชื่อผู้ใช้งานไม่ถูกต้อง');
            return redirect()->to(base_url('/login'));
        } 

    }

    public function RegArea() {

        helper(['form']);
        $session = session(); 
        $userModel = new UsersModel;
        $schoolModel = new SchoolsModel;
        $areaModel = new AreasModel;
        $clusterModel = new ClustersModel;
        $prefixModel = new prefixModel;
        $areaModel = new AreasModel;
        $adminuserModel = new AdminsUsersModel;
        $areauserModel = new AreasUsersModel;
        $clusteruserModel = new ClustersUsersModel;

        if($session->get('checktype') != "area" or isset($session)){
            
            $data = [
                'title' => [
                    '1' => 'ลงทะเบียนสำหรับเขตพื้นที่',
                ],
                'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
                'area' => $areaModel->orderBy('area_id', 'asc')->findall(),
                'cluster' => $clusterModel->orderBy('clus_id', 'asc')->findall(),
            ];
            echo view('frontend/registerArea', $data);
        }else{
            //$session->setFlashdata('msg', 'ชื่อผู้ใช้งานไม่ถูกต้อง');
            return redirect()->to(base_url('/login'));
        } 

    }

    public function RegCluster() {

        helper(['form']);
        $session = session(); 
        $userModel = new UsersModel;
        $schoolModel = new SchoolsModel;
        $areaModel = new AreasModel;
        $clusterModel = new ClustersModel;
        $prefixModel = new prefixModel;
        $areaModel = new AreasModel;
        $adminuserModel = new AdminsUsersModel;
        $areauserModel = new AreasUsersModel;
        $clusteruserModel = new ClustersUsersModel;

        if($session->get('checktype') != "cluster" or isset($session)){
            
            $data = [
                'title' => [
                    '1' => 'ลงทะเบียนสำหรับเขตตรวจราชการ',
                ],
                'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
                'cluster' => $clusterModel->orderBy('clus_id', 'asc')->findall(),
            ];
            echo view('frontend/registerCluster', $data);
        }else{
            //$session->setFlashdata('msg', 'ชื่อผู้ใช้งานไม่ถูกต้อง');
            return redirect()->to(base_url('/login'));
        } 

    }

    public function RegAdmin() {

        helper(['form']);
        $session = session(); 
        $userModel = new UsersModel;
        $schoolModel = new SchoolsModel;
        $areaModel = new AreasModel;
        $clusterModel = new ClustersModel;
        $prefixModel = new prefixModel;
        $areaModel = new AreasModel;
        $adminuserModel = new AdminsUsersModel;
        $areauserModel = new AreasUsersModel;
        $clusteruserModel = new ClustersUsersModel;

        if($session->get('checktype') != "admin" or isset($session)){
            
            $data = [
                'title' => [
                    '1' => 'ลงทะเบียนสำหรับผู้ดูแลระบบ',
                ],
                'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
            ];
            echo view('frontend/registerAdmin', $data);
        }else{
            //$session->setFlashdata('msg', 'ชื่อผู้ใช้งานไม่ถูกต้อง');
            return redirect()->to(base_url('/login'));
        } 

    }

    public function RegObec() {

        helper(['form']);
        $session = session(); 
        $userModel = new UsersModel;
        $schoolModel = new SchoolsModel;
        $areaModel = new AreasModel;
        $clusterModel = new ClustersModel;
        $prefixModel = new prefixModel;
        $areaModel = new AreasModel;
        $adminuserModel = new AdminsUsersModel;
        $areauserModel = new AreasUsersModel;
        $clusteruserModel = new ClustersUsersModel;

        if($session->get('checktype') != "obec" or isset($session)){
            
            $data = [
                'title' => [
                    '1' => 'ลงทะเบียนสำหรับ สพฐ.',
                ],
                'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
            ];
            echo view('frontend/registerObec', $data);
        }else{
            //$session->setFlashdata('msg', 'ชื่อผู้ใช้งานไม่ถูกต้อง');
            return redirect()->to(base_url('/login'));
        } 

    }

    public function areaSearch()
    {
        $areaModel = new AreasModel;
        $code = json_decode($_POST["code"]);
        //$code = $_POST["code"];
        $data = $areaModel->where('area_clus', $code)->findall();
    
        echo json_encode($data);
    }
    
    public function schoolSearch()
    {
        $schoolModel = new SchoolsModel;
        $code = json_decode($_POST["code"]);
        $data = $schoolModel->where('sch_area', $code)->findall();
    
        echo json_encode($data);
    }

    public function saveRegSchool() {

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
            'user_idcard' => [
                'rules' => 'trim|required',
                'errors' => [
                'required' => 'เลขประชาชน ไม่สามารถเว้นว่างได้'
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
        ];
    
        if ($this->validate($rules)) {
            $areasModel = new AreasModel;
            $clustersModel = new ClustersModel;
            $usersModel = new UsersModel;
    
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
                'user_role' => 'User',
                'user_status' => 'Active',
                'user_password' => $this->request->getVar('password'),
                'user_hashpassword' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ];
    
                $usersModel->save($data);
                return redirect()->to(base_url('/' . session()->get('checktype') . '/login'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เพิ่มข้อมูลสำเร็จแล้ว');
                
        } else {
            return redirect()->to(base_url('/' . session()->get('checktype') . '/registerSchool'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> เพิ่มข้อมูลไม่สำเร็จ');

        }

    }

    public function saveRegArea() {

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
            'user_idcard' => [
                'rules' => 'trim|required',
                'errors' => [
                'required' => 'เลขประชาชน ไม่สามารถเว้นว่างได้'
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
        ];
    
        if ($this->validate($rules)) {
            $areasModel = new AreasModel;
            $clustersModel = new ClustersModel;
            $areaUserModel = new AreasUsersModel;

            $data = [
                'user_clus' => $this->request->getVar('user_clus'),
                'user_area' => $this->request->getVar('user_area'),
                'user_prefix' => $this->request->getVar('user_prefix'),
                'user_idcard' => $this->request->getVar('user_idcard'),
                'user_fname' => $this->request->getVar('user_fname'),
                'user_lname' => $this->request->getVar('user_lname'),
                'user_email' => $this->request->getVar('user_email'),
                'user_phone' => $this->request->getVar('user_phone'),
                'user_role' => 'User',
                'user_status' => 'Active',
                'user_password' => $this->request->getVar('password'),
                'user_hashpassword' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ];
    
                $areaUserModel->save($data);
                return redirect()->to(base_url('/' . session()->get('checktype') . '/login'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เพิ่มข้อมูลสำเร็จแล้ว');
                
        } else {
            return redirect()->to(base_url('/' . session()->get('checktype') . '/registerArea'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> เพิ่มข้อมูลไม่สำเร็จ');

        }

    }

    public function saveRegCluster() {

        helper(['form']);
        $rules = [
            'user_clus' => [
                'rules' => 'trim|required',
                'errors' => [
                'required' => 'เขตตรวจราชการ ไม่สามารถเว้นว่างได้'
                ]
            ],
            'user_idcard' => [
                'rules' => 'trim|required',
                'errors' => [
                'required' => 'เลขประชาชน ไม่สามารถเว้นว่างได้'
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
        ];
    
        if ($this->validate($rules)) {
            $clustersModel = new ClustersModel;
            $clusterUserModel = new ClustersUsersModel;

            $data = [
                'user_clus' => $this->request->getVar('user_clus'),
                'user_prefix' => $this->request->getVar('user_prefix'),
                'user_idcard' => $this->request->getVar('user_idcard'),
                'user_fname' => $this->request->getVar('user_fname'),
                'user_lname' => $this->request->getVar('user_lname'),
                'user_email' => $this->request->getVar('user_email'),
                'user_phone' => $this->request->getVar('user_phone'),
                'user_role' => 'User',
                'user_status' => 'Active',
                'user_password' => $this->request->getVar('password'),
                'user_hashpassword' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ];
    
                $clusterUserModel->save($data);
                return redirect()->to(base_url('/' . session()->get('checktype') . '/login'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เพิ่มข้อมูลสำเร็จแล้ว');
                
        } else {
            return redirect()->to(base_url('/' . session()->get('checktype') . '/registerCluster'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> เพิ่มข้อมูลไม่สำเร็จ');

        }

    }

    public function saveRegAdmin() {

        helper(['form']);
        $rules = [
            'user_idcard' => [
                'rules' => 'trim|required',
                'errors' => [
                'required' => 'เลขประชาชน ไม่สามารถเว้นว่างได้'
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
        ];
    
        if ($this->validate($rules)) {
    
            $adminUserModel = new AdminsUsersModel;
    
            $data = [
                'user_prefix' => $this->request->getVar('user_prefix'),
                'user_idcard' => $this->request->getVar('user_idcard'),
                'user_fname' => $this->request->getVar('user_fname'),
                'user_lname' => $this->request->getVar('user_lname'),
                'user_email' => $this->request->getVar('user_email'),
                'user_phone' => $this->request->getVar('user_phone'),
                'user_role' => 'User',
                'user_status' => 'Active',
                'user_password' => $this->request->getVar('password'),
                'user_hashpassword' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ];
    
                $adminUserModel->save($data);
                return redirect()->to(base_url('/' . session()->get('checktype') . '/login'))->with('success', '<i class="fe fe-check-circle fs-16"></i> เพิ่มข้อมูลสำเร็จแล้ว');
                
        } else {
            return redirect()->to(base_url('/' . session()->get('checktype') . '/registerAdmin'))->with('error', '<i class="fe fe-alert-circle fs-16"></i> เพิ่มข้อมูลไม่สำเร็จ');

        }

    }

    public function saveRegObec() {

        return redirect()->to(base_url('/registerObec'));
    }

}