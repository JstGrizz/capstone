<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TimbanganModel;
use App\Models\ReportPanenModel;
use App\Models\MasterBlokModel;
use App\Models\HectareStatementModel;
use App\Models\PolicyModel;
use App\Models\TanamanModel;
use App\Models\StatusModel;
use App\Models\MasterLossesModel;
use App\Models\HistoryLossesModel;
use Fpdf\Fpdf;


class LaporanController extends ResourceController
{

    public function laporanPanenBulanan()
    {
        $timbanganModel = new TimbanganModel();
        $reportPanenModel = new ReportPanenModel();

        // Fetch data from 'timbangan' using ORM
        $timbanganData = $timbanganModel->findAll();

        if (!empty($timbanganData)) {
            foreach ($timbanganData as $row) {
                // Check if the data already exists in 'report_panen' table
                $existingData = $reportPanenModel->where('transaksi_id', $row['transaksi_id'])->first();

                if (!$existingData) { // If no duplicate, insert the data
                    $dataToInsert = [
                        'transaksi_id' => $row['transaksi_id'],
                        'tgl_transaksi' => $row['tgl_transaksi'],
                        'hs_id' => $row['hs_id'],
                        'status_id' => $row['status_id'],
                        'berat_timbangan' => $row['berat_timbangan'],
                        'rfid_tanaman' => $row['rfid_tanaman'],
                        'group_id' => $row['group_id'],
                    ];

                    // Insert the data into 'report_panen'
                    if ($reportPanenModel->insert($dataToInsert)) {
                    } else {
                    }
                } else {
                }
            }
        } else {
            // echo "No data found in timbangan table.\n";
        }

        return view('admin/laporan-panen-bulanan');
    }

    // Fetch report data based on the request body (start_date, end_date, report_type)
    public function fetchReportData()
    {
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');
        $type = $this->request->getGet('report_type');

        $reportPanenModel = new ReportPanenModel();
        $allData = $reportPanenModel->getAggregatedData($start_date, $end_date);

        $finalData = [];
        foreach ($allData as $data) {
            if ($type === 'weight') {
                $finalData[] = [
                    'MonthYear' => date('Y-m', strtotime($data['tanggal'])),
                    'PT' => $data['PT'],
                    'Estate' => $data['Estate'],
                    'Block' => $data['Block'],
                    'Status' => $data['Status'],
                    'jumlah_tanaman' => $data['jumlah_pohon'],
                    'TotalWeight' => $data['Berat'],
                    'AverageTandan' => $data['Berat'] / $data['jumlah_pohon'],
                ];
            } elseif ($type === 'pokok') {
                $finalData[] = [
                    'MonthYear' => date('Y-m', strtotime($data['tanggal'])),
                    'PT' => $data['PT'],
                    'Estate' => $data['Estate'],
                    'Block' => $data['Block'],
                    'Status' => $data['Status'],
                    'jumlah_tanaman' => $data['jumlah_pohon'],
                    'TotalWeight' => $data['Berat'],
                ];
            }
        }

        return $this->response->setJSON($finalData);
    }

    public function laporanPrediksiPanen()
    {

        $hectareStatementModel = new HectareStatementModel();
        $data['ptEstates'] = $hectareStatementModel->getUniquePtEstates();

        // Nilai default untuk fields
        $data['pt'] = '';
        $data['estate'] = '';
        $data['bloks'] = [];
        $data['tahun_tanam'] = '';
        $data['bulan_tanam'] = '';
        $data['luas_tanah'] = '';
        $data['week'] = '';
        $data['varian_bibit'] = '';

        // Jika request adalah POST (saat form disubmit), ini akan dieksekusi.
        // Untuk dropdown policy, kita akan gunakan AJAX terpisah.
        if ($this->request->getMethod() === 'post') {
            // Ambil PT dan Estate yang dipilih
            $ptEstateId = $this->request->getPost('pt_estate');
            $blokId = $this->request->getPost('blok_id');

            // Ambil detail PT dan Estate dari hectare_statement
            $ptEstate = $hectareStatementModel->getPtEstateDetails($ptEstateId);
            if ($ptEstate) {
                $data['pt'] = $ptEstate['pt'];
                $data['estate'] = $ptEstate['estate'];

                // Ambil blok terkait dengan PT Estate yang dipilih dan ada di hectare_statement
                $masterBlokModel = new MasterBlokModel(); // Inisialisasi model di sini
                $data['bloks'] = $masterBlokModel->getBloksInHectareStatement($ptEstateId);

                // Ambil detail blok yang dipilih dan ambil hectare statement
                if ($blokId) {
                    $hectarStatement = $hectareStatementModel->getHectareStatementByPtEstateIdAndBlockId($ptEstateId, $blokId);

                    if ($hectarStatement) {
                        $data['tahun_tanam'] = $hectarStatement['tahun_tanam'];
                        $data['bulan_tanam'] = $hectarStatement['bulan_tanam'];
                        $data['luas_tanah'] = $hectarStatement['luas_tanah'];
                        $data['varian_bibit'] = $hectarStatement['varian_bibit'];

                        // Hitung minggu
                        $data['week'] = $this->calculateWeek($hectarStatement['tanggal_tanam']);
                    }
                }
            }
        }

        return view('admin/laporan-prediksi-panen', $data);
    }

    public function getBloksByPtEstateId($ptEstateId)
    {
        $blokModel = new MasterBlokModel();
        $bloks = $blokModel->getBloksByPtEstateId($ptEstateId);

        return $this->response->setJSON(['bloks' => $bloks]);
    }

    public function getHectareStatementByPtEstateIdAndBlockId($ptEstateId, $blokId)
    {
        $hectareStatementModel = new HectareStatementModel();
        $hectarStatement = $hectareStatementModel->getHectareStatementByPtEstateIdAndBlockId($ptEstateId, $blokId);

        if ($hectarStatement) {
            $hectarStatement['week'] = $this->calculateWeek($hectarStatement['tanggal_tanam']);
            return $this->response->setJSON($hectarStatement);
        }

        return $this->response->setJSON([]);
    }

    // METHOD BARU UNTUK MENGAMBIL DATA POLICY
    public function getPolicies()
    {
        $policyModel = new PolicyModel();
        $policies = $policyModel->findAll();

        return $this->response->setJSON(['policies' => $policies]);
    }

    private function calculateWeek($tanggalTanam)
    {
        $tanggalTanam = new \DateTime($tanggalTanam);
        $today = new \DateTime();
        $interval = $today->diff($tanggalTanam);
        return floor($interval->days / 7);
    }

    public function fetchPrediksiData()
    {
        // 1) Ambil parameter GET
        $ptEstateId = $this->request->getGet('pt_estate');
        $blokId     = $this->request->getGet('blok_id');
        $policyId   = $this->request->getGet('policy_id');

        if (! $ptEstateId || ! $blokId || ! $policyId) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'pt_estate, blok_id, dan policy_id wajib diisi.']);
        }

        // 2) Ambil HS
        $hs = (new HectareStatementModel())
            ->getHectareStatementByPtEstateIdAndBlockId($ptEstateId, $blokId);
        if (! $hs) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Hectare statement tidak ditemukan.']);
        }

        // 3) Ambil policy
        $policy = (new PolicyModel())->find($policyId);
        if (! $policy) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Policy tidak ditemukan.']);
        }

        // 4) Ambil semua tanaman belum panen
        $tanamans = (new TanamanModel())
            ->where('hs_id', $hs['hs_id'])
            ->where('tgl_akhir_identifikasi', null)
            ->findAll();

        // 5) Load semua status, bikin map [status_id => nama_status]
        $statusModel = new StatusModel();
        $allStatuses = $statusModel->findAll();
        $statusMap   = [];
        foreach ($allStatuses as $s) {
            $statusMap[$s['status_id']] = $s['nama_status'];
        }

        $now        = new \DateTime();
        $akhirDate  = $policy['akhir'] !== '0000-00-00 00:00:00'
            ? new \DateTime($policy['akhir'])
            : null;
        $startDate  = $policy['start'] !== '0000-00-00 00:00:00'
            ? new \DateTime($policy['start'])
            : null;

        $report = [];
        foreach ($tanamans as $t) {
            // a) hitung minggu sejak identifikasi
            $tglIdent        = new \DateTime($t['tgl_mulai_identifikasi']);
            $weeksSinceIdent = floor($now->diff($tglIdent)->days / 7);

            // b) umur awal (kolom minggu)
            $initialWeek = (int)$t['minggu'];

            // c) total umur sekarang
            $currentAge = $initialWeek + $weeksSinceIdent;

            // d) pilih threshold policy
            if ($akhirDate && $tglIdent > $akhirDate) {
                $threshold = (int)$policy['lama'];
            } elseif ($startDate && $tglIdent > $startDate) {
                $threshold = (int)$policy['baru'];
            } else {
                $threshold = (int)$policy['lama'];
            }

            if ($threshold <= 0) {
                continue; // abaikan kalau policy invalid
            }

            // e) filter hanya umur ≥ (threshold − 1)
            if ($currentAge < $threshold - 1) {
                continue;
            }

            // f) ambil nama status dari status_id
            $namaStatus = $statusMap[$t['status_id']] ?? '—';

            // g) tambahkan ke hasil
            $report[] = [
                'PT'                  => $hs['pt'],
                'Estate'              => $hs['estate'],
                'Blok'                => $hs['nama_blok'] ?? $hs['blok_id'],
                'TanggalIdentifikasi' => $t['tgl_mulai_identifikasi'],
                'RFIDTanaman'         => $t['rfid_tanaman'],
                'NoTitikTanam'        => $t['no_titik_tanam'],
                'Longitude'           => $t['longitude_tanam'],
                'Latitude'            => $t['latitude_tanam'],
                'Status'              => $namaStatus,
                'Sister'              => $t['sister'],
                'Umur'                => $currentAge,
            ];
        }

        return $this->response->setJSON($report);
    }

    public function fetchAllPrediksiData()
    {
        // 1) Ambil parameter GET: policy_id
        $policyId = $this->request->getGet('policy_id');

        // Validate policy_id is provided
        if (! $policyId) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'policy_id wajib diisi.']);
        }

        // 2) Ambil policy
        $policy = (new PolicyModel())->find($policyId);
        if (! $policy) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Policy tidak ditemukan.']);
        }

        // 3) Ambil semua tanaman belum panen
        $tanamans = (new TanamanModel())
            ->where('tgl_akhir_identifikasi', null)
            ->findAll();

        // If no unharvested plants found, return an empty array
        if (empty($tanamans)) {
            return $this->response->setJSON([]);
        }

        // 4) Load semua status, bikin map [status_id => nama_status]
        $statusModel = new StatusModel();
        $allStatuses = $statusModel->findAll();
        $statusMap = [];
        foreach ($allStatuses as $s) {
            $statusMap[$s['status_id']] = $s['nama_status'];
        }

        // 5) Initialize HectareStatementModel for later use
        $hectareStatementModel = new HectareStatementModel();

        $now = new \DateTime();

        // Prepare policy dates for comparison
        $akhirDate  = $policy['akhir'] !== '0000-00-00 00:00:00'
            ? new \DateTime($policy['akhir'])
            : null;
        $startDate  = $policy['start'] !== '0000-00-00 00:00:00'
            ? new \DateTime($policy['start'])
            : null;

        $report = [];

        foreach ($tanamans as $t) {
            // a) Get Hectare Statement for the current plant
            // Join with master_blok and pt_estate to get full details
            $hs = $hectareStatementModel
                ->select('hectare_statement.*, master_blok.nama_blok, pt_estate.pt, pt_estate.estate')
                ->join('master_blok', 'master_blok.blok_id = hectare_statement.blok_id', 'left')
                ->join('pt_estate', 'pt_estate.pt_estate_id = hectare_statement.pt_estate_id', 'left')
                ->where('hs_id', $t['hs_id'])
                ->first();

            // Skip if no hectare statement found for the plant
            if (!$hs) {
                continue;
            }

            // b) Hitung minggu sejak identifikasi
            $tglIdent        = new \DateTime($t['tgl_mulai_identifikasi']);
            $weeksSinceIdent = floor($now->diff($tglIdent)->days / 7);

            // c) Umur awal (kolom minggu)
            $initialWeek = (int)$t['minggu'];

            // d) Total umur sekarang
            $currentAge = $initialWeek + $weeksSinceIdent;

            // e) Pilih threshold policy based on tgl_mulai_identifikasi
            if ($akhirDate && $tglIdent > $akhirDate) {
                $threshold = (int)$policy['lama'];
            } elseif ($startDate && $tglIdent > $startDate) {
                $threshold = (int)$policy['baru'];
            } else {
                // Default to 'lama' if neither condition matches (e.g., date before start or '0000-00-00')
                $threshold = (int)$policy['lama'];
            }

            // Ensure threshold is valid to prevent division by zero or illogical filters
            if ($threshold <= 0) {
                continue; // Skip if policy threshold is invalid or zero
            }

            // f) Filter only umur ≥ (threshold − 1)
            if ($currentAge < $threshold - 1) {
                continue;
            }

            // g) Ambil nama status dari status_id
            $namaStatus = $statusMap[$t['status_id']] ?? '—';

            // h) Tambahkan ke hasil
            $report[] = [
                'PT'                    => $hs['pt'] ?? '—',
                'Estate'                => $hs['estate'] ?? '—',
                'Blok'                  => $hs['nama_blok'] ?? ($hs['blok_id'] ?? '—'),
                'TanggalIdentifikasi'   => $t['tgl_mulai_identifikasi'],
                'RFIDTanaman'           => $t['rfid_tanaman'],
                'NoTitikTanam'          => $t['no_titik_tanam'],
                'Longitude'             => $t['longitude_tanam'],
                'Latitude'              => $t['latitude_tanam'],
                'Status'                => $namaStatus,
                'Sister'                => $t['sister'],
                'Umur'                  => $currentAge,
            ];
        }

        return $this->response->setJSON($report);
    }

    public function laporanHistoryLosses()
    {
        $tanamanModel = new \App\Models\TanamanModel();
        $historyLossesModel = new \App\Models\HistoryLossesModel();
        $hectareStatementModel = new HectareStatementModel();
        $masterBlokModel = new MasterBlokModel();

        // Sync tanaman with history_losses (only those with tgl_akhir_identifikasi IS NOT NULL and is_loses = 'Y')
        $tanamans = $tanamanModel
            ->where('tgl_akhir_identifikasi IS NOT NULL', null, false)
            ->where('is_loses', 'Y')
            ->findAll();

        foreach ($tanamans as $t) {
            $exists = $historyLossesModel->where('tanaman_id', $t['tanaman_id'])->first();
            if (!$exists) {
                $dataToInsert = $t;
                unset($dataToInsert['tanaman_id']); // remove PK so it can auto-increment
                $dataToInsert['tanaman_id'] = $t['tanaman_id'];
                $historyLossesModel->insert($dataToInsert);
            }
        }

        // Prepare dropdown data (PT & Estate)
        $data['ptEstates'] = $hectareStatementModel->getUniquePtEstates();

        // Default empty values for form fields
        $data['pt'] = '';
        $data['estate'] = '';
        $data['bloks'] = [];
        $data['tahun_tanam'] = '';
        $data['bulan_tanam'] = '';
        $data['luas_tanah'] = '';
        $data['week'] = '';
        $data['varian_bibit'] = '';

        return view('admin/laporan-history-losses', $data);
    }

    public function fetchHistoryLossesReport()
    {
        $historyLossesModel = new \App\Models\HistoryLossesModel();
        $statusModel = new \App\Models\StatusModel();
        $lossesModel = new \App\Models\MasterLossesModel();

        // Get all statuses and build map id => nama_status
        $allStatuses = $statusModel->findAll();
        $statusMap = [];
        foreach ($allStatuses as $s) {
            $statusMap[$s['status_id']] = $s['nama_status'];
        }

        // Get all master losses and build map id => penyebab_losses
        $allLosses = $lossesModel->getAllMasterLosses();
        $lossesMap = [];
        foreach ($allLosses as $l) {
            $lossesMap[$l['losses_id']] = $l['penyebab_losses'];
        }

        // Fetch all history losses
        $historyLosses = $historyLossesModel->findAll();

        $hectareStatementModel = new \App\Models\HectareStatementModel();

        $report = [];
        foreach ($historyLosses as $record) {
            // Join with hectare statement to get pt and estate
            $hs = $hectareStatementModel->select('hectare_statement.*, pt_estate.pt, pt_estate.estate')
                ->join('pt_estate', 'pt_estate.pt_estate_id = hectare_statement.pt_estate_id', 'left')
                ->where('hs_id', $record['hs_id'])
                ->first();

            if (!$hs) continue;

            $report[] = [
                'tgl_mulai_identifikasi' => $record['tgl_mulai_identifikasi'],
                'pt' => $hs['pt'] ?? '-',
                'estate' => $hs['estate'] ?? '-',
                'rfid_tanaman' => $record['rfid_tanaman'],
                'no_titik_tanam' => $record['no_titik_tanam'],
                'longitude_tanam' => $record['longitude_tanam'],
                'latitude_tanam' => $record['latitude_tanam'],
                'status' => $statusMap[$record['status_id']] ?? '-',
                'sister' => $record['sister'],
                'penyebab_losses' => $lossesMap[$record['losses_id']] ?? '-',
                'deskripsi_loses' => $record['deskripsi_loses'],
                'tgl_akhir_identifikasi' => $record['tgl_akhir_identifikasi'],
            ];
        }

        return $this->response->setJSON($report);
    }

    public function fetchAllHistoryLossesReport()
    {
        $historyLossesModel = new \App\Models\HistoryLossesModel();
        $statusModel = new \App\Models\StatusModel();
        $lossesModel = new \App\Models\MasterLossesModel();

        // Get all statuses and build map id => nama_status
        $allStatuses = $statusModel->findAll();
        $statusMap = [];
        foreach ($allStatuses as $s) {
            $statusMap[$s['status_id']] = $s['nama_status'];
        }

        // Get all master losses and build map id => penyebab_losses
        $allLosses = $lossesModel->getAllMasterLosses();
        $lossesMap = [];
        foreach ($allLosses as $l) {
            $lossesMap[$l['losses_id']] = $l['penyebab_losses'];
        }

        // Fetch all history losses without filtering
        $historyLosses = $historyLossesModel->findAll();

        $hectareStatementModel = new \App\Models\HectareStatementModel();

        $report = [];
        foreach ($historyLosses as $record) {
            // Join with hectare statement to get pt and estate
            $hs = $hectareStatementModel->select('hectare_statement.*, pt_estate.pt, pt_estate.estate')
                ->join('pt_estate', 'pt_estate.pt_estate_id = hectare_statement.pt_estate_id', 'left')
                ->where('hs_id', $record['hs_id'])
                ->first();

            if (!$hs) continue;

            $report[] = [
                'tgl_mulai_identifikasi' => $record['tgl_mulai_identifikasi'],
                'pt' => $hs['pt'] ?? '-',
                'estate' => $hs['estate'] ?? '-',
                'rfid_tanaman' => $record['rfid_tanaman'],
                'no_titik_tanam' => $record['no_titik_tanam'],
                'longitude_tanam' => $record['longitude_tanam'],
                'latitude_tanam' => $record['latitude_tanam'],
                'status' => $statusMap[$record['status_id']] ?? '-',
                'sister' => $record['sister'],
                'penyebab_losses' => $lossesMap[$record['losses_id']] ?? '-',
                'deskripsi_loses' => $record['deskripsi_loses'],
                'tgl_akhir_identifikasi' => $record['tgl_akhir_identifikasi'],
            ];
        }

        return $this->response->setJSON($report);
    }

    public function downloadPanenBulananExcel()
    {
        // 1) Read filters
        $start = $this->request->getGet('start_date');
        $end   = $this->request->getGet('end_date');
        $type  = $this->request->getGet('report_type');

        // 2) Fetch raw aggregated data
        $raw = (new ReportPanenModel())->getAggregatedData($start, $end);

        // 3) Transform to rows
        $rows = [];
        foreach ($raw as $d) {
            $r = [
                'Month-Year'       => date('Y-m', strtotime($d['tanggal'])),
                'PT'              => $d['PT'],
                'Estate'          => $d['Estate'],
                'Block'           => $d['Block'],
                'Status'          => $d['Status'],
                'Jumlah Tanaman'   => $d['jumlah_pohon'],
                'Total Weight(kg)' => $d['Berat'],
            ];
            if ($type === 'weight') {
                $r['Average Tandan(kg)'] = round($d['Berat'] / $d['jumlah_pohon'], 2);
            }
            $rows[] = $r;
        }

        // 4) Stream CSV
        $filename = 'laporan-panen-bulanan_' . date('Ymd_His') . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $out = fopen('php://output', 'w');

        if (! empty($rows)) {
            // header row
            fputcsv($out, array_keys($rows[0]));
            foreach ($rows as $r) {
                fputcsv($out, $r);
            }
        }
        fclose($out);
        exit;
    }

    /**
     * Download as PDF via FPDF
     */
    public function downloadPanenBulananPdf()
    {
        // 1) Read filters & data
        $start = $this->request->getGet('start_date');
        $end   = $this->request->getGet('end_date');
        $type  = $this->request->getGet('report_type');
        $raw   = (new ReportPanenModel())->getAggregatedData($start, $end);

        // 2) Transform same as CSV
        $rows = [];
        foreach ($raw as $d) {
            $r = [
                'Month-Year'     => date('Y-m', strtotime($d['tanggal'])),
                'PT'            => $d['PT'],
                'Estate'        => $d['Estate'],
                'Block'         => $d['Block'],
                'Status'        => $d['Status'],
                'Jumlah Tanaman' => $d['jumlah_pohon'],
                'Total Weight'   => $d['Berat'],
            ];
            if ($type === 'weight') {
                $r['Average Tandan'] = round($d['Berat'] / $d['jumlah_pohon'], 2);
            }
            $rows[] = $r;
        }

        // 3) Initialize FPDF
        $pdf = new Fpdf('L', 'mm', 'A4');
        $pdf->SetMargins(10, 10);
        $pdf->AddPage();

        // Title
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Laporan Panen Bulanan', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(
            0,
            6,
            'Periode: ' . date('d-m-Y', strtotime($start)) . ' s/d ' . date('d-m-Y', strtotime($end)),
            0,
            1,
            'C'
        );
        $pdf->Ln(4);

        // 4) Table header
        if (empty($rows)) {
            $pdf->SetFont('Arial', 'I', 12);
            $pdf->Cell(0, 10, 'Tidak ada data untuk periode ini.', 1, 1, 'C');
        } else {
            $header = array_keys($rows[0]);
            $usableWidth = $pdf->GetPageWidth() - 20; // 10mm margins either side
            $colWidth = $usableWidth / count($header);

            // header style
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFillColor(230, 230, 230);
            foreach ($header as $col) {
                $pdf->Cell($colWidth, 7, $col, 1, 0, 'C', true);
            }
            $pdf->Ln();

            // 5) Data rows
            $pdf->SetFont('Arial', '', 9);
            foreach ($rows as $row) {
                foreach ($row as $cell) {
                    $pdf->Cell($colWidth, 6, $cell, 1);
                }
                $pdf->Ln();
            }
        }

        // 6) Output
        $filename = 'laporan-panen-bulanan_' . date('Ymd_His') . '.pdf';
        $pdf->Output('D', $filename);
        exit;
    }

    /**
     * Stream a CSV for History Losses (opens in Excel)
     */
    public function downloadHistoryLossesExcel()
    {
        $ptEstate = $this->request->getGet('pt_estate');
        $blok     = $this->request->getGet('blok_id');

        // load maps
        $statusMap  = array_column((new StatusModel())->findAll(), 'nama_status', 'status_id');
        $lossesMap  = array_column((new MasterLossesModel())->getAllMasterLosses(), 'penyebab_losses', 'losses_id');
        $hsModel    = new HectareStatementModel();
        $histModel  = new HistoryLossesModel();

        $outRows = [];
        foreach ($histModel->findAll() as $rec) {
            $hs = $hsModel
                ->select('hectare_statement.*, pt_estate.pt_estate_id, pt_estate.pt, pt_estate.estate, master_blok.blok_id')
                ->join('pt_estate', 'pt_estate.pt_estate_id=hectare_statement.pt_estate_id', 'left')
                ->join('master_blok', 'master_blok.blok_id=hectare_statement.blok_id', 'left')
                ->where('hs_id', $rec['hs_id'])
                ->first();

            if (! $hs) continue;
            // apply filter if requested
            if ($ptEstate && $blok) {
                if ($hs['pt_estate_id'] != $ptEstate || $hs['blok_id'] != $blok) {
                    continue;
                }
            }

            $outRows[] = [
                'Tgl Identifikasi'       => $rec['tgl_mulai_identifikasi'],
                'PT'                    => $hs['pt'],
                'Estate'                => $hs['estate'],
                'RFID Tanaman'           => $rec['rfid_tanaman'],
                'No Titik Tanam'          => $rec['no_titik_tanam'],
                'Longitude'             => $rec['longitude_tanam'],
                'Latitude'              => $rec['latitude_tanam'],
                'Status'                => $statusMap[$rec['status_id']] ?? '-',
                'Sister'                => $rec['sister'],
                'Penyebab Losses'        => $lossesMap[$rec['losses_id']] ?? '-',
                'Deskripsi Losses'       => $rec['deskripsi_loses'],
                'Tgl Akhir Identifikasi'  => $rec['tgl_akhir_identifikasi'],
            ];
        }

        // CSV download
        $fname = 'laporan-history-losses_' . date('Ymd_His') . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $fname . '"');
        $out = fopen('php://output', 'w');
        if (!empty($outRows)) {
            fputcsv($out, array_keys($outRows[0]));
            foreach ($outRows as $r) fputcsv($out, $r);
        }
        fclose($out);
        exit;
    }

    /**
     * Stream a PDF for History Losses via FPDF
     */
    public function downloadHistoryLossesPdf()
    {
        // 1) Read filters
        $ptEstate = $this->request->getGet('pt_estate');
        $blok     = $this->request->getGet('blok_id');

        // 2) Build the same $outRows as in CSV
        $statusMap = array_column((new StatusModel())->findAll(), 'nama_status', 'status_id');
        $lossesMap = array_column((new MasterLossesModel())->getAllMasterLosses(), 'penyebab_losses', 'losses_id');
        $hsModel   = new HectareStatementModel();
        $histModel = new HistoryLossesModel();

        $outRows = [];
        foreach ($histModel->findAll() as $rec) {
            $hs = $hsModel
                ->select('hectare_statement.*, pt_estate.pt_estate_id, pt_estate.pt, pt_estate.estate, master_blok.blok_id')
                ->join('pt_estate', 'pt_estate.pt_estate_id=hectare_statement.pt_estate_id', 'left')
                ->join('master_blok', 'master_blok.blok_id=hectare_statement.blok_id', 'left')
                ->where('hs_id', $rec['hs_id'])
                ->first();
            if (!$hs) continue;
            if ($ptEstate && $blok) {
                if ($hs['pt_estate_id'] != $ptEstate || $hs['blok_id'] != $blok) continue;
            }
            $outRows[] = [
                'Tgl Identifikasi'      => $rec['tgl_mulai_identifikasi'],
                'PT'                   => $hs['pt'],
                'Estate'               => $hs['estate'],
                'RFID Tanaman'          => $rec['rfid_tanaman'],
                'No Titik Tanam'         => $rec['no_titik_tanam'],
                'Longitude'            => $rec['longitude_tanam'],
                'Latitude'             => $rec['latitude_tanam'],
                'Status'               => $statusMap[$rec['status_id']] ?? '-',
                'Sister'               => $rec['sister'],
                'Penyebab Losses'       => $lossesMap[$rec['losses_id']] ?? '-',
                'Deskripsi Losses'      => $rec['deskripsi_loses'],
                'Tgl Akhir Identifikasi' => $rec['tgl_akhir_identifikasi'],
            ];
        }

        // 3) Initialize FPDF
        $pdf = new Fpdf('L', 'mm', 'A4');
        $pdf->SetMargins(8, 8);
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 8, 'Laporan History Losses', 0, 1, 'C');
        $pdf->Ln(4);

        // if no data, just print message
        if (empty($outRows)) {
            $pdf->SetFont('Arial', 'I', 12);
            $pdf->Cell(0, 8, 'Tidak ada data.', 1, 1, 'C');
            $pdf->Output('D', 'laporan-history-losses_' . date('Ymd_His') . '.pdf');
            exit;
        }

        // 4) Prepare dynamic column widths
        $header    = array_keys($outRows[0]);
        $numCols   = count($header);
        // available width = page width minus left & right margins
        $availableWidth = $pdf->GetPageWidth() - 2 * $pdf->GetX();
        $cellPadding    = 4; // mm of horizontal padding

        // 4a) measure max string width per column (header + all rows)
        $maxWidths = array_fill(0, $numCols, 0);
        $pdf->SetFont('Arial', 'B', 9);
        foreach ($header as $i => $colTitle) {
            $w = $pdf->GetStringWidth($colTitle) + $cellPadding;
            if ($w > $maxWidths[$i]) $maxWidths[$i] = $w;
        }
        $pdf->SetFont('Arial', '', 8);
        foreach ($outRows as $row) {
            foreach (array_values($row) as $i => $cell) {
                $w = $pdf->GetStringWidth((string)$cell) + $cellPadding;
                if ($w > $maxWidths[$i]) $maxWidths[$i] = $w;
            }
        }

        // 4b) scale so total exactly fits availableWidth
        $totalReq = array_sum($maxWidths);
        if ($totalReq > $availableWidth) {
            $scale = $availableWidth / $totalReq;
            foreach ($maxWidths as &$mw) {
                $mw = $mw * $scale;
            }
            unset($mw);
        }

        // 5) Draw header row
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(230, 230, 230);
        foreach ($header as $i => $colTitle) {
            $pdf->Cell($maxWidths[$i], 7, $colTitle, 1, 0, 'C', true);
        }
        $pdf->Ln();

        // 6) Draw data rows
        $pdf->SetFont('Arial', '', 8);
        foreach ($outRows as $row) {
            foreach (array_values($row) as $i => $cell) {
                $pdf->Cell($maxWidths[$i], 6, $cell, 1);
            }
            $pdf->Ln();
        }

        // 7) Output
        $pdf->Output('D', 'laporan-history-losses_' . date('Ymd_His') . '.pdf');
        exit;
    }

    /**
     * Download Prediksi Panen as CSV (for Excel)
     */
    public function downloadPrediksiPanenExcel()
    {
        // 1) Read GET params
        $ptEstate = $this->request->getGet('pt_estate');
        $blok     = $this->request->getGet('blok_id');
        $policyId = $this->request->getGet('policy_id');

        // 2) Validate inputs (replaces deprecated failValidationError)
        if (! $ptEstate || ! $blok || ! $policyId) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'pt_estate, blok_id, and policy_id are required']);
        }

        // 3) Load HS and Policy (replaces failNotFound)
        $hs = (new HectareStatementModel())
            ->getHectareStatementByPtEstateIdAndBlockId($ptEstate, $blok);
        if (! $hs) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Hectare statement not found']);
        }
        $policy = (new PolicyModel())->find($policyId);
        if (! $policy) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Policy not found']);
        }

        // 4) Fetch tanaman & status map
        $tanamans  = (new TanamanModel())
            ->where('hs_id', $hs['hs_id'])
            ->where('tgl_akhir_identifikasi', null)
            ->findAll();
        $statusMap = array_column((new StatusModel())->findAll(), 'nama_status', 'status_id');

        // 5) Build rows
        $now       = new \DateTime();
        $startDate = $policy['start'] !== '0000-00-00 00:00:00'
            ? new \DateTime($policy['start'])
            : null;
        $endDate   = $policy['akhir'] !== '0000-00-00 00:00:00'
            ? new \DateTime($policy['akhir'])
            : null;

        $rows = [];
        foreach ($tanamans as $t) {
            $tglIdent         = new \DateTime($t['tgl_mulai_identifikasi']);
            $weeksSinceIdent  = floor($now->diff($tglIdent)->days / 7);
            $currentAge       = (int)$t['minggu'] + $weeksSinceIdent;

            // threshold logic
            if ($endDate && $tglIdent > $endDate) {
                $threshold = (int)$policy['lama'];
            } elseif ($startDate && $tglIdent > $startDate) {
                $threshold = (int)$policy['baru'];
            } else {
                $threshold = (int)$policy['lama'];
            }
            if ($threshold <= 0 || $currentAge < $threshold - 1) {
                continue;
            }

            $rows[] = [
                'PT'                  => $hs['pt'],
                'Estate'              => $hs['estate'],
                'Blok'                => $hs['nama_blok'] ?? $hs['blok_id'],
                'TanggalIdentifikasi' => $t['tgl_mulai_identifikasi'],
                'RFIDTanaman'         => $t['rfid_tanaman'],
                'NoTitikTanam'        => $t['no_titik_tanam'],
                'Longitude'           => $t['longitude_tanam'],
                'Latitude'            => $t['latitude_tanam'],
                'Status'              => $statusMap[$t['status_id']] ?? '-',
                'Sister'              => $t['sister'],
                'Umur (minggu)'       => $currentAge,
            ];
        }

        // 6) Stream CSV
        $filename = 'laporan-prediksi-panen_' . date('Ymd_His') . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $out = fopen('php://output', 'w');
        if (! empty($rows)) {
            fputcsv($out, array_keys($rows[0]));
            foreach ($rows as $r) {
                fputcsv($out, $r);
            }
        }
        fclose($out);
        exit;
    }

    /**
     * Download ALL Prediksi Panen as CSV (for Excel)
     */
    public function downloadAllPrediksiPanenExcel()
    {
        // 1) Fetch all Tanaman where tgl_akhir_identifikasi IS NULL
        $tanamanModel = new \App\Models\TanamanModel();
        $tanamans     = $tanamanModel
            ->where('tgl_akhir_identifikasi', null)
            ->findAll();

        // 2) Build map of status_id => nama_status
        $statusMap = array_column(
            (new \App\Models\StatusModel())->findAll(),
            'nama_status',
            'status_id'
        );

        // 3) We'll need hectare_statement for each record
        $hsModel = new \App\Models\HectareStatementModel();

        $now  = new \DateTime();
        $rows = [];

        foreach ($tanamans as $t) {
            // join to get pt, estate, nama_blok
            $hs = $hsModel
                ->select('hectare_statement.*, master_blok.nama_blok, pt_estate.pt, pt_estate.estate')
                ->join('master_blok', 'master_blok.blok_id = hectare_statement.blok_id', 'left')
                ->join('pt_estate',  'pt_estate.pt_estate_id = hectare_statement.pt_estate_id', 'left')
                ->where('hs_id', $t['hs_id'])
                ->first();
            if (! $hs) continue;

            // compute umur in weeks
            $tglIdent       = new \DateTime($t['tgl_mulai_identifikasi']);
            $weeksSince     = floor($now->diff($tglIdent)->days / 7);
            $currentAge     = (int)$t['minggu'] + $weeksSince;

            $rows[] = [
                'PT'                    => $hs['pt']               ?? '-',
                'Estate'                => $hs['estate']           ?? '-',
                'Blok'                  => $hs['nama_blok']        ?? $hs['blok_id'],
                'TanggalIdentifikasi'   => $t['tgl_mulai_identifikasi'],
                'RFIDTanaman'           => $t['rfid_tanaman'],
                'NoTitikTanam'          => $t['no_titik_tanam'],
                'Longitude'             => $t['longitude_tanam'],
                'Latitude'              => $t['latitude_tanam'],
                'Status'                => $statusMap[$t['status_id']] ?? '-',
                'Sister'                => $t['sister'],
                'Umur (minggu)'         => $currentAge,
            ];
        }

        // 4) Stream CSV to browser
        $filename = 'prediksi-panen-all_' . date('Ymd_His') . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $out = fopen('php://output', 'w');
        if (! empty($rows)) {
            // header row
            fputcsv($out, array_keys($rows[0]));
            // data rows
            foreach ($rows as $r) {
                fputcsv($out, $r);
            }
        }
        fclose($out);
        exit;
    }

    /**
     * Download Prediksi Panen as PDF via FPDF
     */
    public function downloadPrediksiPanenPdf()
    {
        // 1) Read & validate GET params
        $ptEstate = $this->request->getGet('pt_estate');
        $blok     = $this->request->getGet('blok_id');
        $policyId = $this->request->getGet('policy_id');
        if (! $ptEstate || ! $blok || ! $policyId) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'pt_estate, blok_id, and policy_id are required']);
        }

        // 2) Load HS & Policy
        $hs = (new HectareStatementModel())
            ->getHectareStatementByPtEstateIdAndBlockId($ptEstate, $blok);
        if (! $hs) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Hectare statement not found']);
        }
        $policy = (new PolicyModel())->find($policyId);
        if (! $policy) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Policy not found']);
        }

        // 3) Fetch tanaman & status map
        $tanamans  = (new TanamanModel())
            ->where('hs_id', $hs['hs_id'])
            ->where('tgl_akhir_identifikasi', null)
            ->findAll();
        $statusMap = array_column(
            (new StatusModel())->findAll(),
            'nama_status',
            'status_id'
        );

        // 4) Build data rows
        $now       = new \DateTime();
        $startDate = $policy['start'] !== '0000-00-00 00:00:00'
            ? new \DateTime($policy['start'])
            : null;
        $endDate   = $policy['akhir'] !== '0000-00-00 00:00:00'
            ? new \DateTime($policy['akhir'])
            : null;

        $rows = [];
        foreach ($tanamans as $t) {
            $tglIdent    = new \DateTime($t['tgl_mulai_identifikasi']);
            $weeksSince  = floor($now->diff($tglIdent)->days / 7);
            $currentAge  = (int)$t['minggu'] + $weeksSince;

            // threshold logic
            if ($endDate && $tglIdent > $endDate) {
                $threshold = (int)$policy['lama'];
            } elseif ($startDate && $tglIdent > $startDate) {
                $threshold = (int)$policy['baru'];
            } else {
                $threshold = (int)$policy['lama'];
            }
            if ($threshold <= 0 || $currentAge < $threshold - 1) {
                continue;
            }

            $rows[] = [
                'PT'                    => $hs['pt'],
                'Estate'                => $hs['estate'],
                'Blok'                  => $hs['nama_blok'] ?? $hs['blok_id'],
                'TanggalIdentifikasi'   => $t['tgl_mulai_identifikasi'],
                'RFIDTanaman'           => $t['rfid_tanaman'],
                'NoTitikTanam'          => $t['no_titik_tanam'],
                'Longitude'             => $t['longitude_tanam'],
                'Latitude'              => $t['latitude_tanam'],
                'Status'                => $statusMap[$t['status_id']] ?? '-',
                'Sister'                => $t['sister'],
                'Umur (minggu)'         => $currentAge,
            ];
        }

        // 5) PDF setup
        $pdf    = new Fpdf('L', 'mm', 'A4');
        $margin = 8;
        $pdf->SetMargins($margin, $margin);
        $pdf->AddPage();

        // Title (centered)
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 8, 'Laporan Prediksi Panen', 0, 1, 'C');
        $pdf->Ln(4);

        if (empty($rows)) {
            $pdf->SetFont('Arial', 'I', 12);
            $pdf->Cell(0, 8, 'Tidak ada data untuk kriteria ini.', 1, 1, 'C');
        } else {
            // 6) Compute dynamic column widths
            $header   = array_keys($rows[0]);
            $colCount = count($header);
            $usableW  = $pdf->GetPageWidth() - 2 * $margin;
            $cellPad  = 4;
            $widths   = array_fill(0, $colCount, 0);

            // measure header
            $pdf->SetFont('Arial', 'B', 9);
            foreach ($header as $i => $col) {
                $w = $pdf->GetStringWidth($col) + $cellPad;
                if ($w > $widths[$i]) $widths[$i] = $w;
            }
            // measure content
            $pdf->SetFont('Arial', '', 8);
            foreach ($rows as $row) {
                foreach (array_values($row) as $i => $cell) {
                    $w = $pdf->GetStringWidth((string)$cell) + $cellPad;
                    if ($w > $widths[$i]) $widths[$i] = $w;
                }
            }
            // scale to fit
            $totalW = array_sum($widths);
            if ($totalW > $usableW) {
                $scale = $usableW / $totalW;
                foreach ($widths as &$w) {
                    $w *= $scale;
                }
                unset($w);
                $totalW = $usableW;
            }

            // 7) Compute starting X to center the table
            $startX = ($pdf->GetPageWidth() - $totalW) / 2;

            // 8) Draw header row
            $pdf->SetFillColor(230, 230, 230);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX($startX);
            foreach ($header as $i => $col) {
                $pdf->Cell($widths[$i], 7, $col, 1, 0, 'C', true);
            }
            $pdf->Ln();

            // 9) Draw data rows
            $pdf->SetFont('Arial', '', 8);
            foreach ($rows as $row) {
                $pdf->SetX($startX);
                foreach (array_values($row) as $i => $cell) {
                    $pdf->Cell($widths[$i], 6, $cell, 1);
                }
                $pdf->Ln();
            }
        }

        $pdf->Output('D', 'laporan-prediksi-panen_' . date('Ymd_His') . '.pdf');
        exit;
    }


    /**
     * Download ALL Prediksi Panen as PDF via FPDF
     */
    public function downloadAllPrediksiPanenPdf()
    {
        // 1) Fetch all tanaman
        $tanamans  = (new TanamanModel())
            ->where('tgl_akhir_identifikasi', null)
            ->findAll();
        $statusMap = array_column(
            (new StatusModel())->findAll(),
            'nama_status',
            'status_id'
        );
        $hsModel   = new HectareStatementModel();

        // 2) Build rows
        $now  = new \DateTime();
        $rows = [];
        foreach ($tanamans as $t) {
            $hs = $hsModel
                ->select('hectare_statement.*, master_blok.nama_blok, pt_estate.pt, pt_estate.estate')
                ->join('master_blok', 'master_blok.blok_id = hectare_statement.blok_id', 'left')
                ->join('pt_estate',  'pt_estate.pt_estate_id = hectare_statement.pt_estate_id', 'left')
                ->where('hs_id', $t['hs_id'])
                ->first();
            if (! $hs) continue;

            $tglIdent   = new \DateTime($t['tgl_mulai_identifikasi']);
            $weeksSince = floor($now->diff($tglIdent)->days / 7);
            $currentAge = (int)$t['minggu'] + $weeksSince;

            $rows[] = [
                'PT'                    => $hs['pt']               ?? '-',
                'Estate'                => $hs['estate']           ?? '-',
                'Blok'                  => $hs['nama_blok']        ?? $hs['blok_id'],
                'TanggalIdentifikasi'   => $t['tgl_mulai_identifikasi'],
                'RFIDTanaman'           => $t['rfid_tanaman'],
                'NoTitikTanam'          => $t['no_titik_tanam'],
                'Longitude'             => $t['longitude_tanam'],
                'Latitude'              => $t['latitude_tanam'],
                'Status'                => $statusMap[$t['status_id']] ?? '-',
                'Sister'                => $t['sister'],
                'Umur (minggu)'         => $currentAge,
            ];
        }

        // 3) PDF setup
        $pdf    = new Fpdf('L', 'mm', 'A4');
        $margin = 8;
        $pdf->SetMargins($margin, $margin);
        $pdf->AddPage();

        // Title (center)
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 8, 'Prediksi Panen - Semua Data', 0, 1, 'C');
        $pdf->Ln(4);

        if (empty($rows)) {
            $pdf->SetFont('Arial', 'I', 12);
            $pdf->Cell(0, 8, 'Tidak ada data.', 1, 1, 'C');
        } else {
            // 4) Dynamic widths
            $header   = array_keys($rows[0]);
            $colCount = count($header);
            $usableW  = $pdf->GetPageWidth() - 2 * $margin;
            $cellPad  = 4;
            $widths   = array_fill(0, $colCount, 0);

            // measure header
            $pdf->SetFont('Arial', 'B', 9);
            foreach ($header as $i => $col) {
                $w = $pdf->GetStringWidth($col) + $cellPad;
                if ($w > $widths[$i]) $widths[$i] = $w;
            }
            // measure content
            $pdf->SetFont('Arial', '', 8);
            foreach ($rows as $row) {
                foreach (array_values($row) as $i => $cell) {
                    $w = $pdf->GetStringWidth((string)$cell) + $cellPad;
                    if ($w > $widths[$i]) $widths[$i] = $w;
                }
            }
            // scale to fit
            $totalW = array_sum($widths);
            if ($totalW > $usableW) {
                $scale = $usableW / $totalW;
                foreach ($widths as &$w) {
                    $w *= $scale;
                }
                unset($w);
                $totalW = $usableW;
            }

            // 5) Compute startX for centering
            $startX = ($pdf->GetPageWidth() - $totalW) / 2;

            // 6) Draw header
            $pdf->SetFillColor(230, 230, 230);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX($startX);
            foreach ($header as $i => $col) {
                $pdf->Cell($widths[$i], 7, $col, 1, 0, 'C', true);
            }
            $pdf->Ln();

            // 7) Draw data rows
            $pdf->SetFont('Arial', '', 8);
            foreach ($rows as $row) {
                $pdf->SetX($startX);
                foreach (array_values($row) as $i => $cell) {
                    $pdf->Cell($widths[$i], 6, $cell, 1);
                }
                $pdf->Ln();
            }
        }

        $pdf->Output('D', 'prediksi-panen-all_' . date('Ymd_His') . '.pdf');
        exit;
    }
}
