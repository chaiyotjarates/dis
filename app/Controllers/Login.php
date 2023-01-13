<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\SchoolsModel;
use App\Models\AreasModel;
use App\Models\ClustersModel;
use App\Models\PrefixModel;
use App\Models\AdminsUsersModel;
use App\Models\AreasUsersModel;
use App\Models\ClustersUsersModel;
use App\Models\AdminsLoginsModel;
use App\Models\AreasLoginsModel;
use App\Models\ClustersLoginsModel;
use App\Models\UsersLoginsModel;

use CodeIgniter\Controller;

class Login extends Controller {

    function __construct(){

        helper(['functions']);

    }
      
    public function index() {

        helper(['form']);
        $session = session(); 
        $ses_serverdata = [
            'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
            'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
            'REQUEST_URI' => $_SERVER['REQUEST_URI'],
        ];
        $session->set($ses_serverdata);

        if($session()->get('checktype') == 'admin'):
            return redirect()->to(base_url('/admin'));
        elseif($session()->get('checktype') == 'obec'):
            return redirect()->to(base_url('/obec'));
        elseif($session()->get('checktype') == 'cluster'):
            return redirect()->to(base_url('/cluster'));
        elseif($session()->get('checktype') == 'area'):
            return redirect()->to(base_url('/area'));
        elseif($session()->get('checktype') == 'school'):
            return redirect()->to(base_url('/school'));
        elseif($session()->get('checktype') == 'teacher'):
            return redirect()->to(base_url('/teacher'));
        else:
            $data = [
                'title' => 'เข้าสู่ระบบ'
            ];
            echo view('frontend/index', $data);
        endif;

    }

    public function auth() {
        //$request = \Config\Services::request();
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

        $adminloginModel = new AdminsLoginsModel;
        $arealoginModel = new AreasLoginsModel;
        $clusterloginModel = new ClustersLoginsModel;
        $userloginModel = new UsersLoginsModel; 

        $user_idcard = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $CheckType = $this->request->getVar('checktype');

        if($CheckType==1): // school

        $data = $userModel->where(['user_idcard' => $user_idcard, 'user_status' => 'Active'])->first();
        if($data) {
            $pass = $data['user_hashpassword'];
            $verify_password = password_verify($password, $pass);
            if($verify_password) {
                $schoolname = $schoolModel->where('sch_id', $data['sch_id'])->first();
                $ses_data = [
                    'user_id' => $data['user_id'],
                    'user_idcard' => $data['user_idcard'],
                    'imgProfile' => $data['user_profile'],
                    'prefix' => $data['user_prefix'],
                    'firstname' => $data['user_fname'],
                    'lastname' => $data['user_lname'],
                    'fullname' => $data['user_prefix'].$data['user_fname'].' '.$data['user_lname'],
                    'email' => $data['user_email'],
                    'cluster' => $data['user_clus'],
                    'area' => $data['user_area'],
                    'school' => $data['sch_id'],
                    'schoolName' => $schoolname['sch_name'],
                    'schoolCode' => $schoolname['sch_code'],
                    'role' => $data['user_role'],
                    'checktype' => "school",
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);

                //echo session()->get('role');

                $arrayUserLogin = array(
                    'checktype' => "dis",
                    'ip_address' => $this->request->getIPAddress(),
                    'username' => $data['user_idcard'] ,
                    'clus' => $data['user_clus'],
                    'area' => $data['user_area'],
                    'school' => $data['sch_id'],
                    'last_activity' => time(),
                    'datetime' => date("Y-m-d H:i:s")
                );
                
                $userloginModel->insert($arrayUserLogin);

                return redirect()->to(base_url('/login'));
                
            } else {
                helper(['form']);
                $session->setFlashdata('msg', 'รหัสผ่านไม่ถูกต้อง');
                return redirect()->to(base_url('/login'));
            }
        } else {

            $rowUser = $userModel->where('user_idcard', $user_idcard)->countAllresults();

            if($rowUser == 0){
                
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
                $session->setFlashdata('msg', 'ชื่อผู้ใช้งานไม่ถูกต้อง');
                return redirect()->to(base_url('/login'));
            } 

        }

        elseif($CheckType==2): // area

        $data = $areauserModel->where(['user_idcard' => $user_idcard, 'user_status' => 'Active'])->first();
        if($data) {
            $pass = $data['user_hashpassword'];
            $verify_password = password_verify($password, $pass);
            if($verify_password) {
                //$schoolname = $schoolModel->where('sch_id', $data['sch_id'])->first();
                $areaname = $areaModel->where('area_code', $data['user_area'])->first();
                $ses_data = [
                    'user_id' => $data['user_id'],
                    'user_idcard' => $data['user_idcard'],
                    'imgProfile' => $data['user_profile'],
                    'prefix' => $data['user_prefix'],
                    'firstname' => $data['user_fname'],
                    'lastname' => $data['user_lname'],
                    'fullname' => $data['user_prefix'].$data['user_fname'].' '.$data['user_lname'],
                    'email' => $data['user_email'],
                    'clus' => $data['user_clus'],
                    'area' => $data['user_area'],
                    'areaName' => $areaname['area_name'],
                    'role' => $data['user_role'],
                    'checktype' => "area",
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);

                //echo session()->get('role');

                $arrayAreaLogin = array(
                    'checktype' => "dis",
                    'ip_address' => $this->request->getIPAddress(),
                    'username' => $data['user_idcard'] ,
                    'clus' => $data['user_clus'],
                    'area' => $data['user_area'],
                    'last_activity' => time(),
                    'datetime' => date("Y-m-d H:i:s")
                );
                
                $arealoginModel->insert($arrayAreaLogin);

                return redirect()->to(base_url('/login'));
                

            } else {
                helper(['form']);
                $session->setFlashdata('msg', 'รหัสผ่านไม่ถูกต้อง');
                return redirect()->to(base_url('/login'));
            }
        } else {

            $rowUser = $areauserModel->where('user_idcard', $user_idcard)->countAllresults();

            if($rowUser == 0){
                
                $data = [
                    'title' => [
                        '1' => 'ลงทะเบียนสำหรับเขตพื้นที่ฯ',
                    ],
                    'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
                    'area' => $areaModel->orderBy('area_id', 'asc')->findall(),
                    'cluster' => $clusterModel->orderBy('clus_id', 'asc')->findall(),
                ];
                echo view('frontend/registerArea', $data);
            }else{
                $session->setFlashdata('msg', 'ชื่อผู้ใช้งานไม่ถูกต้อง');
                return redirect()->to(base_url('/login'));
            } 

        }

        elseif($CheckType==3): // cluster

        $data = $clusteruserModel->where(['user_idcard' => $user_idcard, 'user_status' => 'Active'])->first();
        if($data) {
            $pass = $data['user_hashpassword'];
            $verify_password = password_verify($password, $pass);
            if($verify_password) {
                //$schoolname = $schoolModel->where('sch_id', $data['sch_id'])->first();
                $clustername = $clusterModel->where('clus_id', $data['user_clus'])->first();
                $ses_data = [
                    'user_id' => $data['user_id'],
                    'user_idcard' => $data['user_idcard'],
                    'imgProfile' => $data['user_profile'],
                    'prefix' => $data['user_prefix'],
                    'firstname' => $data['user_fname'],
                    'lastname' => $data['user_lname'],
                    'fullname' => $data['user_prefix'].$data['user_fname'].' '.$data['user_lname'],
                    'email' => $data['user_email'],
                    'clus' => $data['user_clus'],
                    'clusName' => $clustername['clus_name'],
                    'role' => $data['user_role'],
                    'checktype' => "cluster",
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);

                //echo session()->get('role');

                $arrayClusLogin = array(
                    'checktype' => "dis",
                    'ip_address' => $this->request->getIPAddress(),
                    'username' => $data['user_idcard'] ,
                    'clus' => $data['user_clus'],
                    'last_activity' => time(),
                    'datetime' => date("Y-m-d H:i:s")
                );
                
                $clusterloginModel->insert($arrayClusLogin);

                return redirect()->to(base_url('/login'));
                

            } else {
                helper(['form']);
                $session->setFlashdata('msg', 'รหัสผ่านไม่ถูกต้อง');
                return redirect()->to(base_url('/login'));
            }
        } else {

            $rowUser = $clusteruserModel->where('user_idcard', $user_idcard)->countAllresults();

            if($rowUser == 0){
                
                $data = [
                    'title' => [
                        '1' => 'ลงทะเบียนสำหรับเขตตรวจราชการ',
                    ],
                    'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
                    'cluster' => $clusterModel->orderBy('clus_id', 'asc')->findall(),
                ];
                echo view('frontend/registerCluster', $data);
            }else{
                $session->setFlashdata('msg', 'ชื่อผู้ใช้งานไม่ถูกต้อง');
                return redirect()->to(base_url('/login'));
            } 

        }

        elseif($CheckType==4): // admin

        $data = $adminuserModel->where(['user_idcard' => $user_idcard, 'user_status' => 'Active'])->first();
        if($data) {
            $pass = $data['user_hashpassword'];
            $verify_password = password_verify($password, $pass);
            if($verify_password) {
                //$schoolname = $schoolModel->where('sch_id', $data['sch_id'])->first();
                //$clustername = $clusterModel->where('clus_id', $data['user_clus'])->first();
                $ses_data = [
                    'user_id' => $data['user_id'],
                    'user_idcard' => $data['user_idcard'],
                    'imgProfile' => $data['user_profile'],
                    'prefix' => $data['user_prefix'],
                    'firstname' => $data['user_fname'],
                    'lastname' => $data['user_lname'],
                    'fullname' => $data['user_prefix'].$data['user_fname'].' '.$data['user_lname'],
                    'email' => $data['user_email'],
                    'role' => $data['user_role'],
                    'checktype' => "admin",
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);

                //echo session()->get('role');

                $arrayAdminLogin = array(
                    'checktype' => "dis",
                    'ip_address' => $this->request->getIPAddress(),
                    'username' => $data['user_idcard'] ,
                    'last_activity' => time(),
                    'datetime' => date("Y-m-d H:i:s")
                );
                
                $adminloginModel->insert($arrayAdminLogin);

                return redirect()->to(base_url('/login'));
                

            } else {
                helper(['form']);
                $session->setFlashdata('msg', 'รหัสผ่านไม่ถูกต้อง');
                return redirect()->to(base_url('/login'));
            }
        } else {

            $rowUser = $adminuserModel->where('user_idcard', $user_idcard)->countAllresults();

            if($rowUser == 0){
                
                $data = [
                    'title' => [
                        '1' => 'ลงทะเบียนสำหรับผู้ดูแลระบบ',
                    ],
                    'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
                ];
                echo view('frontend/registerAdmin', $data);
            }else{
                $session->setFlashdata('msg', 'ชื่อผู้ใช้งานไม่ถูกต้อง');
                return redirect()->to(base_url('/login'));
            } 

        }
        elseif($CheckType==5): // obec

        else:
            $data = [
                'title' => 'เข้าสู่ระบบ'
            ];
            echo view('frontend/index', $data);
        endif;


    }

    public function registerSchool()
    {
        helper(['form']);
        $rules = [
        'user' => [
            'rules' => 'trim|required|is_unique[user.user_idcard]',
            'errors' => [
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้',
            'is_unique' => 'ชื่อผู้ใช้นี้ในระบบแล้ว'
            ]
        ],
        'user_prefix' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'คำนำหน้า ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_fname' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'ชื่อ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_lname' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'นามสกุล ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_password' => [
            'rules' => 'trim|required',
            'errors' => [
            'required' => 'รหัสผ่านใหม่ ไม่สามารถเว้นว่างได้'
            ]
        ],
        'user_confpassword' => [
            'rules' => 'trim|required|matches[user_password]',
            'errors' => [
            'required' => 'ยืนยันรหัสผ่าน ไม่สามารถเว้นว่างได้',
            'matches' => 'การยืนยันรหัสผ่านใหม่ ไม่ตรงกัน'
            ]
        ]
        ];

        if ($this->validate($rules)) {

            $usermodel = new UsersModel();

            $data = array(
                'user_prefix'    => $this->request->getVar('user_prefix'),
                'user_fname' => $this->request->getVar('user_fname'),
                'user_lname'  => $this->request->getVar('user_lname'),
                'user_idcard'     => $this->request->getVar('user'),
                'sch_id'    => $this->request->getVar('sch_id'),
                'user_role'    => 'school',
                'user_password'  => $this->request->getVar('user_password'),
                'user_hashpassword'  => password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT),
                'user_dateregis' => date("Y-m-d H:i:s"),
                'user_area' => $this->request->getVar('user_area'),
                'user_status' => 'Active'
            );
    
            $usermodel->insert($data);
    
            return redirect()->to(base_url('/login'))->with('success', '<i class="far fa-check-circle fs-16"></i> บันทึกข้อมูลสำเร็จ เข้าสู่ระบบอีกครั้ง');

        } else {

            helper(['form']);

            $model = new UsersModel();
            $schoolModel = new SchoolsModel;
            $areaModel = new AreasModel;
            $prefixModel = new prefixModel();

            $school = $schoolModel->where('sch_code', $this->request->getVar('user'))->first();

            $rowUser = $model->where('user_idcard', $this->request->getVar('user'))->countAllresults();

            if($school && ($rowUser == 0)){
                
                $area = $areaModel->where('area_code', $school['sch_area'])->first();

                $data = [
                    'title' => 'ลงทะเบียนสำหรับโรงเรียน',
                    'sch_code' => $school['sch_code'],
                    'sch_id' => $school['sch_id'],
                    'sch_name' => $school['sch_name'],
                    'area_code' => $area['area_code'],
                    'area_name' => $area['area_name'],
                    'area_id' => $area['area_id'],
                    'prefix' => $prefixModel->orderBy('prefix_id', 'asc')->findall(),
                    'validation' => $this->validator
                ];
                echo view('frontend/registerSchool', $data);
            }else{
                $session->setFlashdata('msg', 'เกิดข้อผิดพลาด กรุณาเข้าสู่ระบบใหม่อีกครั้ง');
                return redirect()->to(base_url('/login'));
            }


        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }

    
}