<?php

namespace App\Models;

use CodeIgniter\Model;

class AreasUsersModel extends Model
{
  protected $table = 'area_user';
  protected $primaryKey = 'user_id';
  protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array('user_clus','user_area','user_idcard','user_profile','user_prefix','user_fname','user_lname','user_email','user_phone','user_password','user_hashpassword','user_dateregis','user_role','user_status','reset_link_token','exp_date');
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

  public function getAreasUsers($id = false)
  {
    if ($id === false) 
      {
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['user_id' => $id])
                ->first();
  }






}
