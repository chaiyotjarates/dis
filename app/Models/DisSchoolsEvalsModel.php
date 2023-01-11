<?php

namespace App\Models;

use CodeIgniter\Model;

class DisSchoolsEvalsModel extends Model
{
  protected $table = 'dis_school_eval';
  protected $primaryKey = 'sche_id';
  //protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array('sche_user','sche_sch','sche_area','sche_conf','sche_year','sche_cate','sche_link','sche_posted','sche_posted_date','sche_status');
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
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['sche_id' => $id])
                ->first();
  }


}
