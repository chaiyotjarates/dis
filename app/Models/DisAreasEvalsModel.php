<?php

namespace App\Models;

use CodeIgniter\Model;

class DisAreasEvalsModel extends Model
{
  protected $table = 'dis_area_eval';
  protected $primaryKey = 'are_id';
  //protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array('are_user','are_area','are_conf','are_year','are_cate','are_link','are_posted','are_posted_date','are_status');
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime'; // datetime or date or int // ค่า defalut เป็น datetime
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  // กำหนดการจัดการส่วนของการ delete() 
  //protected $useSoftDeletes = true;
  protected $deletedField  = 'deleted_at';

  public function getDisAreasEvalsID($id = false)
  {
    if ($id === false) 
      {
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['are_id' => $id])
                ->first();
  }


}
