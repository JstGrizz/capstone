<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Penentuan Masa Panen</title>

    <link rel="shortcut icon" href="<?= base_url('/assets/compiled/svg/favicon.svg'); ?>" type="image/x-icon" />
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png" />

    <link rel="stylesheet" href="<?= base_url('/assets/extensions/simple-datatables/style.css'); ?>" />

    <link rel="stylesheet" href="<?= base_url('/assets/compiled/css/table-datatable.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('/assets/compiled/css/app.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('/assets/compiled/css/app-dark.css'); ?>" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <style>
        .table-centered th,
        .table-centered td {
            text-align: center;
            justify-content: center;
        }
    </style>
    <script src="<?= base_url('/assets/static/js/initTheme.js'); ?>"></script>
    <div id="app">
        <?= view('sidebar'); ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Laporan Penentuan Masa Panen</h3>
                            <p class="text-subtitle text-muted">
                                Form untuk Penentuan Masa Panen
                            </p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Laporan Penentuan Masa Panen
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>Laporan Penentuan Masa Panen</h4>
                        </div>
                        <div class="card-body">
                            <form id="reportForm">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <!-- PT & Estate Dropdown -->
                                        <div class="form-group">
                                            <label for="pt_estate">PT & Estate</label>
                                            <select class="form-control" id="pt_estate" name="pt_estate"
                                                onchange="updateBloks()">
                                                <option value="">Select PT and Estate</option>
                                                <?php foreach ($ptEstates as $ptEstate): ?>
                                                    <option value="<?= $ptEstate['pt_estate_id']; ?>">
                                                        <?= $ptEstate['pt']; ?> - <?= $ptEstate['estate']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Blok Selection -->
                                        <div class="form-group">
                                            <label for="blok_id">Nama Blok</label>
                                            <select class="form-control" id="blok_id" name="blok_id">
                                                <option value="">Select Blok</option>
                                            </select>
                                        </div>

                                        <!-- Umur Tanam (Minggu) -->
                                        <div class="form-group">
                                            <label for="week">Umur Tanam (Minggu)</label>
                                            <input type="text" id="week" class="form-control" name="week" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label for="policy_id">Pilih Policy</label>
                                            <select class="form-control" id="policy_id" name="policy_id">
                                                <option value="">Pilih Policy Panen</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <!-- Tahun Tanam -->
                                        <div class="form-group">
                                            <label for="tahun_tanam">Tahun Tanam</label>
                                            <input type="text" id="tahun_tanam" class="form-control" name="tahun_tanam"
                                                readonly />
                                        </div>

                                        <!-- Bulan Tanam -->
                                        <div class="form-group">
                                            <label for="bulan_tanam">Bulan Tanam</label>
                                            <input type="text" id="bulan_tanam" class="form-control" name="bulan_tanam"
                                                readonly />
                                        </div>

                                        <!-- Luas Tanah (Ha) -->
                                        <div class="form-group">
                                            <label for="luas_tanah">Luas Tanah (Ha)</label>
                                            <input type="text" id="luas_tanah" class="form-control" name="luas_tanah"
                                                readonly />
                                        </div>

                                        <!-- Varian Bibit -->
                                        <div class="form-group">
                                            <label for="varian_bibit">Varian Bibit</label>
                                            <input type="text" id="varian_bibit" class="form-control"
                                                name="varian_bibit" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <br>
                                        <button type="button" id="generateReportBtn"
                                            class="btn btn-primary me-1 mb-1 w-100">
                                            Generate Laporan Penentuan Masa Panen By Filter
                                        </button>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <br>
                                        <button type="button" id="generateAllReportBtn"
                                            class="btn btn-secondary me-1 mb-1 w-100">
                                            Generate Semua Laporan Penentuan Masa Panen
                                        </button>
                                    </div>
                                    <div id="download-buttons-prediksi" class="col-12 mt-3" style="display:none;">
                                        <a id="download-prediksi-excel" class="btn btn-success me-2">
                                            <i class="bi bi-file-earmark-spreadsheet-fill"></i> Download Excel
                                        </a>
                                        <a id="download-prediksi-pdf" class="btn btn-danger">
                                            <i class="bi bi-file-earmark-pdf-fill"></i> Download PDF
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Data Laporan Penentuan Masa Panen</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped" id="reportTable"
                                        style="width: 100%; text-align: center;">
                                        <thead>
                                            <tr>
                                                <th>PT</th>
                                                <th>Estate</th>
                                                <th>Blok</th>
                                                <th>Tanggal Identifikasi</th>
                                                <th>RFID Tanaman</th>
                                                <th>No Titik Tanam</th>
                                                <th>Longitude</th>
                                                <th>Latitude</th>
                                                <th>Status</th>
                                                <th>Sister</th>
                                                <th>Umur</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataResults">
                                            <!-- Data will be inserted here via JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?= view('footer'); ?>
        </div>
    </div>
    <script src="<?= base_url('/assets/static/js/components/dark.js'); ?>"></script>
    <script src="<?= base_url('/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js'); ?>"></script>

    <script src="<?= base_url('/assets/compiled/js/app.js'); ?>"></script>

    <script src="<?= base_url('/assets/extensions/simple-datatables/umd/simple-datatables.js'); ?>"></script>
    <script src="<?= base_url('/assets/static/js/pages/simple-datatables.js'); ?>"></script>
    <script src=" <?= base_url('/assets/static/js/pages/simple-datatables.js'); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const baseUrl = '<?= base_url(); ?>';

            // mapping DOM elements
            const els = {
                ptEstate: document.getElementById('pt_estate'),
                blokId: document.getElementById('blok_id'),
                tahun: document.getElementById('tahun_tanam'),
                bulan: document.getElementById('bulan_tanam'),
                luas: document.getElementById('luas_tanah'),
                varian: document.getElementById('varian_bibit'),
                week: document.getElementById('week'),
                policy: document.getElementById('policy_id'),
                gen: document.getElementById('generateReportBtn'),
                genAll: document.getElementById('generateAllReportBtn'),
                tbody: document.getElementById('dataResults')
            };

            // populate policy dropdown
            async function loadPolicies() {
                try {
                    const res = await fetch(`${baseUrl}laporan/penentuan-masa-panen/getPolicies`);
                    const {
                        policies
                    } = await res.json();
                    els.policy.innerHTML =
                        '<option value="">Pilih Policy Panen</option>'; // Corrected default text
                    policies.forEach(p => {
                        const opt = document.createElement('option');
                        opt.value = p.policy_id;
                        opt.textContent = p.deskripsi;
                        els.policy.appendChild(opt);
                    });
                } catch (e) {
                    console.error(e);
                    alert('Error loading policies');
                }
            }

            // update blok dropdown when PT changes
            async function updateBloks() {
                els.blokId.innerHTML = '<option value="">Select Blok</option>';
                clearHS();
                try {
                    const res = await fetch(
                        `${baseUrl}laporan/penentuan-masa-panen/getBloksByPtEstateId/${els.ptEstate.value}`);
                    const {
                        bloks
                    } = await res.json();
                    bloks.forEach(b => {
                        const o = document.createElement('option');
                        o.value = b.blok_id;
                        o.textContent = b.nama_blok;
                        els.blokId.appendChild(o);
                    });
                } catch (e) {
                    console.error(e);
                    alert('Error loading bloks');
                }
            }

            // autofill hectare statement fields
            async function autoFillFields() {
                clearHS();
                if (!els.ptEstate.value || !els.blokId.value) return;
                try {
                    const res = await fetch(
                        `${baseUrl}laporan/penentuan-masa-panen/getHectareStatementByPtEstateIdAndBlockId/${els.ptEstate.value}/${els.blokId.value}`
                    );
                    const data = await res.json();
                    els.tahun.value = data.tahun_tanam || '';
                    els.bulan.value = data.bulan_tanam || '';
                    els.luas.value = data.luas_tanah || '';
                    els.varian.value = data.varian_bibit || '';
                    els.week.value = data.week || '';
                } catch (e) {
                    console.error(e);
                    alert('Error loading Hectare Statement');
                }
            }

            function clearHS() {
                els.tahun.value = '';
                els.bulan.value = '';
                els.luas.value = '';
                els.varian.value = '';
                els.week.value = '';
            }

            // populate table rows
            function populateTable(rows) {
                els.tbody.innerHTML = '';
                if (!rows.length) {
                    els.tbody.innerHTML = '<tr><td colspan="11" class="text-center">No data</td></tr>';
                    return;
                }
                rows.forEach(r => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                    <td>${r.PT}</td>
                    <td>${r.Estate}</td>
                    <td>${r.Blok}</td>
                    <td>${r.TanggalIdentifikasi}</td>
                    <td>${r.RFIDTanaman}</td>
                    <td>${r.NoTitikTanam}</td>
                    <td>${r.Longitude || '-'}</td>
                    <td>${r.Latitude || '-'}</td>
                    <td>${r.Status}</td>
                    <td>${r.Sister}</td>
                    <td>${r.Umur}</td>
                `;
                    els.tbody.appendChild(tr);
                });
            }

            // show & wire download buttons
            function showDownloadButtonsPrediksi(params) {
                const downloadExcelBtn = $('#download-prediksi-excel');
                const downloadPdfBtn = $('#download-prediksi-pdf');

                if (params) {
                    // Filtered download (for specific PT, Blok, Policy)
                    downloadExcelBtn.attr('href', baseUrl + 'laporan/penentuan-masa-panen/downloadExcel?' + params);
                    downloadPdfBtn.attr('href', baseUrl + 'laporan/penentuan-masa-panen/downloadPdf?' + params);
                } else {
                    // "Generate Semua" download (for all data with policy_id)
                    // This assumes downloadAllExcel/Pdf also accept policy_id
                    const policyId = els.policy.value; // Get policy ID for "all" downloads
                    if (!policyId) {
                        // This case shouldn't be reached if `genAll` has policy validation,
                        // but good for robustness.
                        alert('Policy ID is required for full report downloads.');
                        $('#download-buttons-prediksi').hide();
                        return;
                    }
                    downloadExcelBtn.attr('href', baseUrl +
                        'laporan/penentuan-masa-panen/downloadAllExcel?policy_id=' + policyId);
                    downloadPdfBtn.attr('href', baseUrl + 'laporan/penentuan-masa-panen/downloadAllPdf?policy_id=' +
                        policyId);
                }
                $('#download-buttons-prediksi').show();
            }

            // generate filtered report
            els.gen.addEventListener('click', async () => {
                const pt = els.ptEstate.value;
                const bl = els.blokId.value;
                const pol = els.policy.value; // Get policy ID for filtered report
                if (!pt || !bl || !pol) {
                    return alert('Please select PT & Estate, Blok, and Policy.');
                }
                try {
                    const res = await fetch(
                        `${baseUrl}laporan/penentuan-masa-panen/data?pt_estate=${pt}&blok_id=${bl}&policy_id=${pol}`
                    );
                    const data = await res.json();
                    populateTable(data);
                    showDownloadButtonsPrediksi(`pt_estate=${pt}&blok_id=${bl}&policy_id=${pol}`);
                } catch (e) {
                    console.error(e);
                    alert('Error fetching data');
                }
            });

            // generate all report
            els.genAll.addEventListener('click', async () => {
                const pol = els.policy.value; // Get policy ID for all report
                if (!pol) {
                    return alert('Please select a Policy for the "Generate All" report.');
                }
                try {
                    // Pass policy_id to the data-all endpoint
                    const res = await fetch(
                        `${baseUrl}laporan/penentuan-masa-panen/data-all?policy_id=${pol}`);
                    const data = await res.json();
                    populateTable(data);
                    // Update download links for "all" data, including policy_id
                    showDownloadButtonsPrediksi(''); // Pass empty string as a flag for "all" downloads
                } catch (e) {
                    console.error(e);
                    alert('Error fetching all data');
                }
            });

            // initial load
            loadPolicies();
            els.ptEstate.addEventListener('change', updateBloks);
            els.blokId.addEventListener('change', autoFillFields);
        });
    </script>
</body>

</html>