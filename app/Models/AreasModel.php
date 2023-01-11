<?php

namespace App\Models;

use CodeIgniter\Model;

class AreasModel extends Model
{
  protected $table = 'area';
  protected $primaryKey = 'area_id';
  protected $allowedFields = array("area_clus","area_code","area_name","area_type");


  public function getAreas($id = false)
  {
    if ($id === false) 
      {
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['area_id' => $id])
                ->first();
  }



}
