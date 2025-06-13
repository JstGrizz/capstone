<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan History Losses</title>

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
                            <h3>Laporan History Losses</h3>
                            <p class="text-subtitle text-muted">
                                Form untuk History Losses
                            </p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Laporan History Losses
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>Laporan History Losses</h4>
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
                                            <select class="form-control" id="blok_id" name="blok_id"
                                                onchange="autoFillFields()">
                                                <option value="">Select Blok</option>
                                            </select>
                                        </div>

                                        <!-- Umur Tanam (Minggu) -->
                                        <div class="form-group">
                                            <label for="week">Umur Tanam (Minggu)</label>
                                            <input type="text" id="week" class="form-control" name="week" readonly />
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
                                            Generate Laporan History Losses By Filter
                                        </button>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <br>
                                        <button type="button" id="generateAllReportBtn"
                                            class="btn btn-secondary me-1 mb-1 w-100">
                                            Generate Semua Laporan History Losses
                                        </button>
                                    </div>
                                    <div id="download-buttons-history" class="col-12 mt-3" style="display:none;">
                                        <a id="download-history-excel" class="btn btn-success me-2">
                                            <i class="bi bi-file-earmark-spreadsheet-fill"></i> Download Excel
                                        </a>
                                        <a id="download-history-pdf" class="btn btn-danger">
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
                                    <h4 class="card-title">Data Laporan History Losses</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped" id="historyLossesTable"
                                        style="width: 100%; text-align: center;">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Mulai Identifikasi</th>
                                                <th>PT</th>
                                                <th>Estate</th>
                                                <th>RFID Tanaman</th>
                                                <th>No Titik Tanam</th>
                                                <th>Longitude</th>
                                                <th>Latitude</th>
                                                <th>Status</th>
                                                <th>Sister</th>
                                                <th>Penyebab Losses</th>
                                                <th>Deskripsi Losses</th>
                                                <th>Tanggal Akhir Identifikasi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataResults">
                                            <!-- data rows inserted here -->
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
        const baseUrl = '<?= base_url(); ?>';
        let lastParams = ''; // will hold pt_estate & blok_id

        // Helper to fetch JSON
        async function fetchJSON(url) {
            const res = await fetch(url);
            if (!res.ok) throw new Error(res.statusText);
            return res.json();
        }

        // When PT & Estate changes, reload the blok dropdown
        $('#pt_estate').on('change', () => {
            $('#download-buttons-history').hide();
            $('#blok_id').html('<option value="">Select Blok</option>');
            $('#dataResults').empty();
            $('#tahun_tanam, #bulan_tanam, #luas_tanah, #week').val('');

            const pt = $('#pt_estate').val();
            if (!pt) return;

            fetchJSON(`${baseUrl}laporan/penentuan-masa-panen/getBloksByPtEstateId/${pt}`)
                .then(data => {
                    data.bloks.forEach(b =>
                        $('#blok_id').append(`<option value="${b.blok_id}">${b.nama_blok}</option>`)
                    );
                })
                .catch(err => alert('Error loading bloks: ' + err));
        });

        // When Blok changes, autofill the hectare statement fields
        $('#blok_id').on('change', autoFillFields);

        function autoFillFields() {
            $('#download-buttons-history').hide();
            $('#dataResults').empty();
            $('#tahun_tanam, #bulan_tanam, #luas_tanah, #week').val('');

            const pt = $('#pt_estate').val();
            const bl = $('#blok_id').val();
            if (!pt || !bl) return;

            fetchJSON(`${baseUrl}laporan/penentuan-masa-panen/getHectareStatementByPtEstateIdAndBlockId/${pt}/${bl}`)
                .then(d => {
                    $('#tahun_tanam').val(d.tahun_tanam);
                    $('#bulan_tanam').val(d.bulan_tanam);
                    $('#luas_tanah').val(d.luas_tanah);
                    $('#week').val(d.week);
                })
                .catch(err => alert('Error loading hectare statement: ' + err));
        }

        // Fill the table body
        function populateTable(rows) {
            const $tb = $('#dataResults').empty();
            if (!rows.length) {
                $tb.append('<tr><td colspan="12" class="text-center">No data</td></tr>');
                return;
            }
            rows.forEach(r => {
                $tb.append(`
        <tr>
          <td>${r.tgl_mulai_identifikasi}</td>
          <td>${r.pt}</td>
          <td>${r.estate}</td>
          <td>${r.rfid_tanaman}</td>
          <td>${r.no_titik_tanam}</td>
          <td>${r.longitude_tanam}</td>
          <td>${r.latitude_tanam}</td>
          <td>${r.status}</td>
          <td>${r.sister}</td>
          <td>${r.penyebab_losses}</td>
          <td>${r.deskripsi_loses}</td>
          <td>${r.tgl_akhir_identifikasi}</td>
        </tr>
      `);
            });
        }

        // Show and wire up the download buttons
        function showDownloadButtons(params) {
            lastParams = params;
            $('#download-history-excel').attr(
                'href',
                `${baseUrl}laporan/history-losses/downloadExcel?${params}`
            );
            $('#download-history-pdf').attr(
                'href',
                `${baseUrl}laporan/history-losses/downloadPdf?${params}`
            );
            $('#download-buttons-history').show();
        }

        // Generate filtered report
        $('#generateReportBtn').on('click', async () => {
            const pt = $('#pt_estate').val();
            const bl = $('#blok_id').val();
            if (!pt || !bl) {
                return alert('Please select PT & Estate and Blok first.');
            }

            try {
                const data = await fetchJSON(
                    `${baseUrl}laporan/history-losses/data?pt_estate=${pt}&blok_id=${bl}`
                );
                populateTable(data);
                showDownloadButtons(`pt_estate=${pt}&blok_id=${bl}`);
            } catch (err) {
                alert('Error fetching report: ' + err);
            }
        });

        // Generate all report
        $('#generateAllReportBtn').on('click', async () => {
            try {
                const data = await fetchJSON(`${baseUrl}laporan/history-losses/data-all`);
                populateTable(data);
                showDownloadButtons(''); // no filters
            } catch (err) {
                alert('Error fetching all data: ' + err);
            }
        });
    </script>
</body>

</html>