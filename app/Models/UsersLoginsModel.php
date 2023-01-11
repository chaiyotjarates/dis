<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersLoginsModel extends Model
{
  protected $table = 'users_login';
  protected $primaryKey = 'ul_id';
  //protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array('checktype','ip_address','username','clus','area','school','last_activity','datetime');
  //protected $useTimestamps = true;
  //protected $dateFormat = 'datetime'; // datetime or date or int // ค่า defalut เป็น datetime
  //protected $createdField  = 'created_at';
  //protected $updatedField  = 'updated_at';
  // กำหนดการจัดการส่วนของการ delete() 
  //protected $useSoftDeletes = true;
  //protected $deletedField  = 'deleted_at';

  public function getUsersLogins($id = false)
  {
    if ($id === false) 
      {
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['ul_id' => $id])
                ->first();
  }






}
