<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolsModel extends Model
{
  protected $table = 'school';
  protected $primaryKey = 'sch_id';
  protected $allowedFields = array("sch_id","sch_clus","sch_area","sch_code","sch_name");

  public function getSchools($id = false)
  {
    if ($id === false) 
      {
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['sch_id' => $id])
                ->first();
  }

}
