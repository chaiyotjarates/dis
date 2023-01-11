<?php

namespace App\Models;

use CodeIgniter\Model;

class SupersOnlinesModel extends Model
{
  protected $table = 'supervis_online';
  protected $primaryKey = 'uid';
  protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array('uid','checktype','username','ip_address','user_agent','last_activity','uri');
  //protected $useTimestamps = true;
  //protected $dateFormat = 'datetime'; // datetime or date or int // ค่า defalut เป็น datetime
  //protected $createdField  = 'created_at';
  //protected $updatedField  = 'updated_at';
  // กำหนดการจัดการส่วนของการ delete() 
  //protected $useSoftDeletes = true;
  //protected $deletedField  = 'deleted_at';
  
  public function getSupersOnlines($id = false)
  {
    if ($id === false) 
      {
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['uid' => $id])
                ->first();
  }






}
