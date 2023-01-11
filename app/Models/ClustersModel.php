<?php

namespace App\Models;

use CodeIgniter\Model;

class ClustersModel extends Model
{
  protected $table = 'cluster';
  protected $primaryKey = 'clus_id';
  protected $allowedFields = array("clus_id","clus_name","clus_short");

  public function getClusters($id = false)
  {
    if ($id === false) 
      {
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['clus_id' => $id])
                ->first();
  }



}
