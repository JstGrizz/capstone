<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Karyawan</title>

    <link rel="shortcut icon" href="<?= base_url('/assets/compiled/svg/favicon.svg'); ?>" type="image/x-icon" />
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png" />

    <link rel="stylesheet" href="<?= base_url('/assets/extensions/simple-datatables/style.css'); ?>" />

    <link rel="stylesheet" href="<?= base_url('/assets/compiled/css/table-datatable.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('/assets/compiled/css/app.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('/assets/compiled/css/app-dark.css'); ?>" />
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
                            <h3>Edit Karyawan</h3>
                            <p class="text-subtitle text-muted">
                                Mengubah data karyawan <?= $karyawan['nama']; ?>
                            </p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a href="<?= base_url('master-karyawan'); ?>">Master Karyawan</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Edit Karyawan
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <form id="update-karyawan-form"
                                action="<?= base_url('master-karyawan/update/' . $karyawan['karyawan_id']); ?>"
                                method="post">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <label for="npk" class="form-label">NPK</label>
                                    <input type="text" class="form-control" id="npk" name="npk"
                                        value="<?= $karyawan['npk']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="<?= $karyawan['nama']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                                        value="<?= $karyawan['jabatan']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="L"
                                            <?= isset($karyawan['gender']) && $karyawan['gender'] === 'L' ? 'selected' : '' ?>>
                                            Laki-laki</option>
                                        <option value="P"
                                            <?= isset($karyawan['gender']) && $karyawan['gender'] === 'P' ? 'selected' : '' ?>>
                                            Perempuan</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="golongan" class="form-label">Golongan</label>
                                    <input type="text" class="form-control" id="golongan" name="golongan"
                                        placeholder="Masukkan golongan karyawan"
                                        value="<?= isset($karyawan['golongan']) ? $karyawan['golongan'] : '' ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                        value="<?= isset($karyawan['tgl_lahir']) ? $karyawan['tgl_lahir'] : '' ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="tgl_join" class="form-label">Tanggal Bergabung</label>
                                    <input type="date" class="form-control" id="tgl_join" name="tgl_join"
                                        value="<?= isset($karyawan['tgl_join']) ? $karyawan['tgl_join'] : '' ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="tgl_termination" class="form-label">Tanggal Terminasi</label>
                                    <input type="date" class="form-control" id="tgl_termination" name="tgl_termination"
                                        value="<?= isset($karyawan['tgl_termination']) ? $karyawan['tgl_termination'] : '' ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="status_karyawan" class="form-label">Status Karyawan</label>
                                    <select class="form-select" id="status_karyawan" name="status_karyawan">
                                        <option value="tetap"
                                            <?= isset($karyawan['status_karyawan']) && $karyawan['status_karyawan'] === 'tetap' ? 'selected' : '' ?>>
                                            Tetap</option>
                                        <option value="harian lepas"
                                            <?= isset($karyawan['status_karyawan']) && $karyawan['status_karyawan'] === 'harian lepas' ? 'selected' : '' ?>>
                                            Harian Lepas</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="lokasi_id" class="form-label">Lokasi Kerja</label>
                                    <select class="form-select" id="lokasi_id" name="lokasi_id">
                                        <!-- Options will be populated here by JavaScript -->
                                    </select>
                                </div>
                                <!-- Add other fields as necessary -->
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
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
        document.addEventListener('DOMContentLoaded', function() {
            const updateForm = document.getElementById('update-karyawan-form');
            const currentLokasiId = <?= json_encode($karyawan['lokasi_id']); ?>;
            const lokasiDropdown = document.getElementById('lokasi_id');
            const baseUrl = '<?= base_url(); ?>';

            updateForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the form from submitting through the browser

                const formData = new FormData(updateForm);
                const jsonData = {};
                formData.forEach((value, key) => {
                    jsonData[key] = value;
                });



                fetch(updateForm.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json', // Setting content type to JSON
                            'X-Requested-With': 'XMLHttpRequest' // Ensure to handle as AJAX in CI4
                        },
                        body: JSON.stringify(jsonData) // Convert the JavaScript object to a JSON string
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert(data.message);
                        if (data.success) {
                            window.location.href =
                                '<?= base_url('master-karyawan'); ?>'; // Redirect on success
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to update karyawan: ' + error.message);
                    });
            });

            fetch(`${baseUrl}/master-lokasi/data`)
                .then(response => response.json())
                .then(data => {
                    lokasiDropdown.innerHTML = '';
                    data.lokasi.forEach(l => {
                        const option = new Option(l.nama_lokasi, l.lokasi_id);
                        if (l.lokasi_id === currentLokasiId) {
                            option.selected = true; // Set the current lokasi as selected
                        }
                        lokasiDropdown.add(option);
                    });
                })
                .catch(error => console.error('Error loading lokasi:', error));
        });
    </script>
</body>

</html>