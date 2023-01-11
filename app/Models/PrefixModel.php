<?php

namespace App\Models;

use CodeIgniter\Model;

class PrefixModel extends Model
{
  protected $table = 'prefix';
  protected $primaryKey = 'prefix_id';
  protected $allowedFields = array("prefix_title");

  public function getPrefixs($id = false)
  {
    if ($id === false) 
      {
        return $this->findAll();
      }
    return $this->asArray()
                ->where(['prefix_id' => $id])
                ->first();
  }

}
