<?php

namespace App\Models;

use CodeIgniter\Model;

class HectareStatementModel extends Model
{
    protected $table = 'hectare_statement';
    protected $primaryKey = 'hs_id';
    protected $allowedFields = ['luas_tanah', 'tanggal_tanam', 'jumlah_pohon', 'created_at', 'updated_at', 'varian_bibit', 'tahun_tanam', 'bulan_tanam', 'sph', 'blok_id', 'pt_estate_id'];
    protected $returnType = 'array';

    public function getHectarStatementsWithNames()
    {
        return $this->select('hectare_statement.*, master_blok.nama_blok, pt_estate.pt, pt_estate.estate')
            ->join('master_blok', 'master_blok.blok_id = hectare_statement.blok_id', 'left')
            ->join('pt_estate', 'pt_estate.pt_estate_id = hectare_statement.pt_estate_id', 'left')
            ->findAll();
    }

    public function getHectareStatementByPtEstateIdAndBlockId($ptEstateId, $blokId)
    {
        return $this->select('hectare_statement.*, master_blok.nama_blok, pt_estate.pt, pt_estate.estate')
            ->join('master_blok', 'master_blok.blok_id = hectare_statement.blok_id', 'left')
            ->join('pt_estate', 'pt_estate.pt_estate_id = hectare_statement.pt_estate_id', 'left')
            ->where('hectare_statement.pt_estate_id', $ptEstateId)
            ->where('hectare_statement.blok_id', $blokId)
            ->first();
    }

    public function getUniquePtEstates()
    {
        return $this->select('pt_estate.pt_estate_id, pt_estate.pt, pt_estate.estate')
            ->join('pt_estate', 'pt_estate.pt_estate_id = hectare_statement.pt_estate_id', 'left')
            ->distinct()
            ->orderBy('pt_estate.pt', 'ASC')
            ->findAll();
    }

    public function getPtEstateDetails($ptEstateId)
    {
        return $this->select('pt_estate.pt, pt_estate.estate')
            ->join('pt_estate', 'pt_estate.pt_estate_id = hectare_statement.pt_estate_id', 'left')
            ->where('hectare_statement.pt_estate_id', $ptEstateId)
            ->first();
    }
}
