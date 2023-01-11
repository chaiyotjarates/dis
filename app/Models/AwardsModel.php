<?php

namespace App\Models;

use CodeIgniter\Model;

class AwardsModel extends Model
{
  protected $table = 'dis_award';
  protected $primaryKey = 'id';
  protected $allowedFields = array("user_id", "url", "datetime", "status");

  public function getUsers($id = false)
  {
    if ($id === false) 
      {
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['user_id' => $id])
                ->first();
  }

}
