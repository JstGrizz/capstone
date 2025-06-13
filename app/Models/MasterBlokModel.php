<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterBlokModel extends Model
{
    protected $table = 'master_blok';
    protected $primaryKey = 'blok_id';
    protected $allowedFields = ['nama_blok', 'pt_estate_id'];
    protected $returnType = 'array';


    public function getBlokWithPtEstateName()
    {
        return $this->select('master_blok.*, pt_estate.pt as pt, pt_estate.estate as estate')
            ->join('pt_estate', 'pt_estate.pt_estate_id = master_blok.pt_estate_id', 'left')
            ->findAll();
    }

    public function getBloksByPtEstateId($pt_estate_id)
    {
        return $this->where('pt_estate_id', $pt_estate_id)->findAll();
    }

    public function getBloksInHectareStatement($pt_estate_id)
    {
        return $this->select('master_blok.*')
            ->join('hectare_statement', 'hectare_statement.blok_id = master_blok.blok_id', 'inner')
            ->where('master_blok.pt_estate_id', $pt_estate_id)
            ->distinct()
            ->findAll();
    }
}
