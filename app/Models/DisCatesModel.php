<?php

namespace App\Models;

use CodeIgniter\Model;

class DisCatesModel extends Model
{
  protected $table = 'dis_cate';
  protected $primaryKey = 'ca_id';
  //protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array('ca_year','ca_tsite','ca_title','ca_super','ca_posted','ca_posted_date','ca_status');
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime'; // datetime or date or int // ค่า defalut เป็น datetime
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  // กำหนดการจัดการส่วนของการ delete() 
  //protected $useSoftDeletes = true;
  protected $deletedField  = 'deleted_at';

  public function getDisCates($id = false)
  {
    if ($id === false) 
      {
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['ca_id' => $id])
                ->first();
  }



}
