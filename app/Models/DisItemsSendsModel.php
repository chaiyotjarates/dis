<?php

namespace App\Models;

use CodeIgniter\Model;

class DisItemsSendsModel extends Model
{
  protected $table = 'dis_item_send';
  protected $primaryKey = 'citt_id';
  //protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array('area_id','user_id','sch_id','user_level','year','citt_sig','citt_posted','citt_posted_date');
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime'; // datetime or date or int // ค่า defalut เป็น datetime
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  // กำหนดการจัดการส่วนของการ delete() 
  //protected $useSoftDeletes = true;
  protected $deletedField  = 'deleted_at';

  public function getDisItemsSendsID($id = false)
  {
    if ($id === false) 
      {
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['citt_id' => $id])
                ->first();
  }


}
