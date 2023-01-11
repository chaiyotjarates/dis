<?php

namespace App\Models;

use CodeIgniter\Model;

class DisItemsCommsModel extends Model
{
  protected $table = 'dis_item_comm';
  protected $primaryKey = 'citm_id';
  //protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array('area_id','user_id','sch_id','user_level','year','citm_comm','citm_posted','citm_posted_date','citm_update_date');
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime'; // datetime or date or int // ค่า defalut เป็น datetime
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  // กำหนดการจัดการส่วนของการ delete() 
  //protected $useSoftDeletes = true;
  protected $deletedField  = 'deleted_at';

  public function getDisItemsCommsID($id = false)
  {
    if ($id === false) 
      {
        return $this->where(['citm_status'=>'Active'])
                ->findAll();
      }
    return $this->asArray()
                ->where(['citm_id' => $id,'citm_status'=>'Active'])
                ->first();
  }


}
