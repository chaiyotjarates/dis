<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
  protected $table = 'user';
  protected $primaryKey = 'user_id';
  //protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array("user_id","user_clus","user_area","sch_id","user_idcard","user_profile","user_prefix","user_fname","user_lname","user_phone","user_email","user_password","user_hashpassword","user_dateregis", "user_role","user_status","reset_link_token","exp_date");
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime'; // datetime or date or int // ค่า defalut เป็น datetime
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  // กำหนดการจัดการส่วนของการ delete() 
  //protected $useSoftDeletes = true;
  protected $deletedField  = 'deleted_at';

  public function changePassword($password, $id)
  {
    $return = false;
    $q = $this->find($id);
    if ($q) {
      if (password_verify($password, $q['user_hashpassword'])) {

        $return = true;
      }
    }
    return $return;
  }

  public function getUsers($id = false)
  {
    if ($id === false) 
      {
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['user_id' => $id])
                ->first();
  }

  public function getUserAllSearch($search = false) {
    if($search === false) {
      $this->select('user.*,area.*,school.*,(user.user_id) as user_id,
            CONCAT(user.user_prefix,user_fname," ",user.user_lname) As username')
            ->join('area', 'area.area_code=user.user_area', 'LEFT')
            ->join('school', 'school.sch_id=user.sch_id', 'LEFT')
            ->findAll();
    }
    return  $this->select('user.*,area.*,school.*,(user.user_id) as user_id,
          CONCAT(user.user_prefix,user_fname," ",user.user_lname) As username')
          ->join('area', 'area.area_code=user.user_area', 'LEFT')
          ->join('school', 'school.sch_id=user.sch_id', 'LEFT')
          //->where("username like '%$search%' ")
          ->where("user.user_lname like '%$search%' or user.user_lname like '%$search%' or area.area_name like '%$search%' or school.sch_name like '%$search%'")
          //->where("user.user_fname like '%$search%'")
         // ->where("area.area_name like '%$search%'")
          //->where("school.sch_name like '%$search%'")
          //->where("user.user_lname like '%$search%' ")
          ->findAll();
}

public function getUserAllSearchLimit($limit = false, $length = false, $search = false) {
    if($search === false) {
        return $this->select('user.*,area.*,school.*,(user.user_id) as user_id,
          CONCAT(user.user_prefix,user_fname," ",user.user_lname) As username')
          ->join('area', 'area.area_code=user.user_area', 'LEFT')
          ->join('school', 'school.sch_id=user.sch_id', 'LEFT')
          ->limit($limit,$length)
          ->findAll();
    }
    return  $this->select('user.*,area.*,school.*,(user.user_id) as user_id,
          CONCAT(user.user_prefix,user_fname," ",user.user_lname) As username')
          ->join('area', 'area.area_code=user.user_area', 'LEFT')
          ->join('school', 'school.sch_id=user.sch_id', 'LEFT')
          //->where("username like '%$search%' ")
          ->where("user.user_lname like '%$search%' or user.user_lname like '%$search%' or area.area_name like '%$search%' or school.sch_name like '%$search%'")
          //->where("user.user_fname like '%$search%'")
          //->where("area.area_name like '%$search%'")
          //->where("school.sch_name like '%$search%'")
          //->where("user.user_lname like '%$search%' ")
          ->limit($limit,$length)
          ->findAll();
}

public function getUserAll() {

  return  $this->select('user.*,area.*,school.*,(user.user_id) as user_id,
          CONCAT(user.user_prefix,user_fname," ",user.user_lname) As username')
          ->join('area', 'area.area_code=user.user_area', 'LEFT')
          ->join('school', 'school.sch_id=user.sch_id', 'LEFT')
          //->where(['user_up.iu_area' => session()->get('area_code'),'user_up.iu_school' => session()->get('sch_code')])
          //->orderBy('C_id', 'DESC')
          //->groupby('user.id')
          ->findAll();

}

public function getUserAllLimit($limit = false, $length = false) {

  return  $this->select('user.*,area.*,school.*,(user.user_id) as user_id,
          CONCAT(user.user_prefix,user_fname," ",user.user_lname) As username')
          ->join('area', 'area.area_code=user.user_area', 'LEFT')
          ->join('school', 'school.sch_id=user.sch_id', 'LEFT')
          //->where(['user.it_main' => $main,'user.it_sub' => $sub])
          ->limit($limit,$length)
          //->orderBy('user.user_id', 'DESC')
          //->groupby('user.user_id')
          ->findAll();
}




}
