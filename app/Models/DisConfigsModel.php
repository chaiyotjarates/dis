<?php

namespace App\Models;

use CodeIgniter\Model;

class DisConfigsModel extends Model
{
  protected $table = 'dis_config';
  protected $primaryKey = 'co_id';
  //protected $returnType     = 'array'; // array or object or custom class
  protected $allowedFields = array('co_title','co_year','co_date_start','co_date_end','co_areascore_start','co_areascore_end','co_clusscore_start','co_clusscore_end','co_datenote_start','co_datenote_end','co_datescore_start','co_datescore_end','co_datepublish','co_posted','co_posted_date','co_status');
  
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime'; // datetime or date or int // ค่า defalut เป็น datetime
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  // กำหนดการจัดการส่วนของการ delete() 
  //protected $useSoftDeletes = true;
  protected $deletedField  = 'deleted_at';

  public function getDisConfigsID($id = false)
  {
    if ($id === false) 
      {
        return $this->asArray()
                ->where(['co_status'=>'Active'])
                ->findAll();
      }
    return $this->asArray()
                ->where(['co_id' => $id,'co_status'=>'Active'])
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
