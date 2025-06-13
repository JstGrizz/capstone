<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterLossesModel extends Model
{
    protected $table = 'master_losses';
    protected $primaryKey = 'losses_id';
    protected $allowedFields = ['penyebab_losses'];
    protected $returnType = 'array';

    public function getAllMasterLosses()
    {
        return $this->select('losses_id, penyebab_losses')
            ->findAll();
    }
}
