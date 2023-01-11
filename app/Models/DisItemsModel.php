<?php

namespace App\Models;

use CodeIgniter\Model;

class DisItemsModel extends Model
{
  protected $table = 'dis_item';
  protected $primaryKey = 'cit_id';
  //protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array('cit_type','cit_num','cit_sub','cit_title','cit_posted','cit_posted_date','cit_view','cit_status');
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime'; // datetime or date or int // ค่า defalut เป็น datetime
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  // กำหนดการจัดการส่วนของการ delete() 
  //protected $useSoftDeletes = true;
  protected $deletedField  = 'deleted_at';

  public function getDisItemsID($id = false)
  {
    if ($id === false) 
      {
        return $this->where(['cit_status'=>'Active'])
                ->findAll();
      }
    return $this->asArray()
                ->where(['cit_id' => $id,'cit_status'=>'Active'])
                ->first();
  }


}
