<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportPanenModel extends Model
{
    protected $table = 'report_panen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['transaksi_id', 'tgl_transaksi', 'hs_id', 'status_id', 'berat_timbangan', 'rfid_tanaman', 'group_id'];

    // In your ReportPanenModel.php

    public function getAggregatedData(string $startDate = null, string $endDate = null)
    {
        $builder = $this->db->table('report_panen rp')
            ->select('
            DATE(rp.tgl_transaksi) AS tanggal,
            pt.pt AS PT,
            pt.estate AS Estate,
            mb.nama_blok AS Block,
            COUNT(*) AS jumlah_pohon,
            s.nama_status AS Status,
            SUM(rp.berat_timbangan) AS Berat
        ')
            ->join('hectare_statement hs', 'rp.hs_id = hs.hs_id')
            ->join('status s', 'rp.status_id = s.status_id')
            ->join('pt_estate pt', 'hs.pt_estate_id = pt.pt_estate_id')
            ->join('master_blok mb', 'hs.blok_id = mb.blok_id');

        if ($startDate && $endDate) {
            $builder->where('DATE(rp.tgl_transaksi) >=', $startDate)
                ->where('DATE(rp.tgl_transaksi) <=', $endDate);
        }

        $builder->groupBy('pt.pt, pt.estate, mb.nama_blok, s.nama_status');

        return $builder->get()->getResultArray();
    }
}
