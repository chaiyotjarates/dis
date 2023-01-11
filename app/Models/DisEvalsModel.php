<?php

namespace App\Models;

use CodeIgniter\Model;

class DisEvalsModel extends Model
{
  protected $table = 'dis_eval';
  protected $primaryKey = 'eval_id';
  //protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array('eval_user','eval_sch','eval_area','eval_type','eval_conf','eval_year','eval_cate','eval_link','eval_posted','eval_posted_date','eval_status');
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime'; // datetime or date or int // ค่า defalut เป็น datetime
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  // กำหนดการจัดการส่วนของการ delete() 
  //protected $useSoftDeletes = true;
  protected $deletedField  = 'deleted_at';

  public function getDisSchoolsEvalsID($id = false)
  {
    if ($id === false) 
      {
        return $this->where(['eval_status' => 'Active'])
                ->findAll();
      }
    return $this->asArray()
                ->where(['eval_id' => $id,'eval_status' => 'Active'])
                ->first();
  }


}
