<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\ReportPanenModel;
use App\Models\HistoryLossesModel;
use App\Models\TanamanModel;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        // 1. Cek session login
        $session = session();
        $npk     = $session->get('npk');

        if (! $session->get('isLoggedIn') || ! $npk) {
            return redirect()->to('/login');
        }

        // 2. Ambil data karyawan (sesuai npk)
        $karyawanModel = new KaryawanModel();
        $karyawan      = $karyawanModel->getKaryawanNameWithNpk($npk);
        if (! $karyawan) {
            $session->remove('npk');
            $session->remove('isLoggedIn');
            return redirect()->to('/login');
        }

        // 3. Hitung “jumlah karyawan”
        //    - countAll() akan melakukan SELECT COUNT(*) FROM karyawan
        $jumlahKaryawan = $karyawanModel->countAll();

        // 4. Hitung “jumlah tanaman aktif”
        //    Kondisi: tgl_akhir_identifikasi IS NULL
        $tanamanModel = new TanamanModel();
        $jumlahTanamanAktif = $tanamanModel
            ->where('tgl_akhir_identifikasi', null)
            ->countAllResults();

        // 5. Hitung “tanaman yang telah panen di tahun ini”
        $currentYear         = date('Y');
        $reportPanenModel    = new ReportPanenModel();
        $jumlahPanenThisYear = $reportPanenModel
            ->where("YEAR(tgl_transaksi)", $currentYear)
            ->countAllResults();

        // 6. Hitung “tanaman yang losses di tahun ini”
        $historyLossesModel   = new HistoryLossesModel();
        $jumlahLossesThisYear = $historyLossesModel
            ->where("YEAR(tgl_mulai_identifikasi)", $currentYear)
            ->where('is_loses', 'Y')
            ->countAllResults();

        // 7. Hitung “panen per bulan” (untuk chart, optional)
        $panenModel   = new ReportPanenModel();
        $builderPanen = $panenModel->builder();
        $builderPanen
            ->select("MONTH(tgl_transaksi) AS bulan, COUNT(*) AS total")
            ->where("YEAR(tgl_transaksi)", $currentYear)
            ->groupBy("MONTH(tgl_transaksi)");
        $resultsPanen = $builderPanen->get()->getResultArray();

        $countsPanenPerMonth = array_fill(1, 12, 0);
        foreach ($resultsPanen as $row) {
            $bulan = (int) $row['bulan'];
            $countsPanenPerMonth[$bulan] = (int) $row['total'];
        }
        $panenCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $panenCounts[] = $countsPanenPerMonth[$i];
        }

        // 8. Hitung “losses per bulan” (untuk chart, optional)
        $lossesModel   = new HistoryLossesModel();
        $builderLoss   = $lossesModel->builder();
        $builderLoss
            ->select("MONTH(tgl_mulai_identifikasi) AS bulan, COUNT(*) AS total")
            ->where("YEAR(tgl_mulai_identifikasi)", $currentYear)
            ->where("is_loses", "Y")
            ->groupBy("MONTH(tgl_mulai_identifikasi)");
        $resultsLosses = $builderLoss->get()->getResultArray();

        $countsLossesPerMonth = array_fill(1, 12, 0);
        foreach ($resultsLosses as $row) {
            $bulan = (int) $row['bulan'];
            $countsLossesPerMonth[$bulan] = (int) $row['total'];
        }
        $lossesCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $lossesCounts[] = $countsLossesPerMonth[$i];
        }

        // 9. Label bulan (optional, jika ingin ditampilkan di chart)
        $panenLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // 10. Kirim semua data ke view
        $data = [
            'karyawan'              => $karyawan,
            'jumlahKaryawan'        => $jumlahKaryawan,
            'jumlahTanamanAktif'    => $jumlahTanamanAktif,
            'jumlahPanenThisYear'   => $jumlahPanenThisYear,
            'jumlahLossesThisYear'  => $jumlahLossesThisYear,
            'panenCounts'           => $panenCounts,
            'panenLabels'           => $panenLabels,
            'lossesCounts'          => $lossesCounts,
            'currentYear'           => $currentYear
        ];

        return view('admin/index', $data);
    }
}
