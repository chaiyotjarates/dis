<?php

namespace App\Models;

use CodeIgniter\Model;

class DisYearsModel extends Model
{
  protected $table = 'dis_year';
  protected $primaryKey = 'y_id';
  //protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array('y_name','y_posted','y_posted_date','y_status');
  
  //protected $useTimestamps = true;
  //protected $dateFormat = 'datetime'; // datetime or date or int // ค่า defalut เป็น datetime
  //protected $createdField  = 'created_at';
  //protected $updatedField  = 'updated_at';
  // กำหนดการจัดการส่วนของการ delete() 
  //protected $useSoftDeletes = true;
  //protected $deletedField  = 'deleted_at';

  public function getDisYearsID($id = false)
  {
    if ($id === false) 
      {
        return $this->asArray()
                ->where(['y_status'=>'Active'])
                ->findAll();
      }
    return $this->asArray()
                ->where(['y_id' => $id,'y_status'=>'Active'])
                ->first();
  }

  public function getDisConfigsYear($year = false)
  {
    if ($year === false) 
      {
        return $this->asArray()
                ->where(['co_status'=>'Active'])
                ->findAll();
      }
    return $this->asArray()
                ->where(['co_year' => $year,'co_status'=>'Active'])
                ->first();
  }



}
