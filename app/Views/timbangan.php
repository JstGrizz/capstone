<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Timbangan</title>

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
                            <h3>Timbangan</h3>
                            <p class="text-subtitle text-muted">
                                Form untuk melakukan timbangan tandan
                            </p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Timbangan
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <form class="form" id="timbangan">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Group</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="rfid_group">RFID Group</label>
                                    <input type="text" id="rfid_group" class="form-control" name="rfid_group" />
                                </div>
                                <div class="form-group">
                                    <label for="nama_group">Nama Group</label>
                                    <input type="text" id="nama_group" class="form-control" name="nama_group"
                                        readonly />
                                </div>
                                <div class="form-group">
                                    <label for="nama_mandor">Nama Mandor</label>
                                    <ul id="mandor_list"></ul>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="multiple-column-form">
                        <div class="row match-height">

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Data Timbangan</h4>
                                        <p>Masukkan Data Untuk Melakukan Timbangan</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="rfid_tanaman">RFID Tanaman</label>
                                                    <input type="text" id="rfid_tanaman" class="form-control"
                                                        name="rfid_tanaman" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="berat_timbangan">Berat</label>
                                                    <input type="text" id="berat_timbangan" class="form-control"
                                                        name="berat_timbangan" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary me-1 mb-1"
                                                id="submitTimbangan">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Data Tanaman</h4>
                                        <p>Data terkait tanaman sesuai RFID</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="nama_karyawan">Nama Pemasang RFID</label>
                                                    <input type="text" id="nama_karyawan" class="form-control"
                                                        name="nama_karyawan" readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label for="npk">NPK</label>
                                                    <input type="text" id="npk" class="form-control" name="npk"
                                                        readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label for="pt_estate">PT & Estate</label>
                                                    <input type="text" id="pt_estate" class="form-control"
                                                        name="pt_estate" readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_blok">Nama Blok</label>
                                                    <input type="text" id="nama_blok" class="form-control"
                                                        name="nama_blok" readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <input type="text" id="status" class="form-control" name="status"
                                                        readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label for="sister">Sister</label>
                                                    <input type="text" id="sister" class="form-control" name="sister"
                                                        readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="no_titik_tanam">No Titik Tanam</label>
                                                    <input type="text" id="no_titik_tanam" class="form-control"
                                                        name="no_titik_tanam" readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label for="tgl_identifikasi_tanaman">Tanggal Identifikasi
                                                        Tanaman</label>
                                                    <input type="text" id="tgl_identifikasi_tanaman"
                                                        class="form-control" name="tgl_identifikasi_tanaman" readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label for="tahun_tanam">Tahun Tanam</label>
                                                    <input type="text" id="tahun_tanam" class="form-control"
                                                        name="tahun_tanam" readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label for="bulan_tanam">Bulan Tanam</label>
                                                    <input type="text" id="bulan_tanam" class="form-control"
                                                        name="bulan_tanam" readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label for="luas_tanah">Luas Tanah (Ha)</label>
                                                    <input type="text" id="luas_tanah" class="form-control"
                                                        name="luas_tanah" readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label for="varian_bibit">Varian Bibit</label>
                                                    <input type="text" id="varian_bibit" class="form-control"
                                                        name="varian_bibit" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
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
        document.getElementById('rfid_group').addEventListener('change', function() {
            const rfidGroup = this.value;
            fetch(`timbangan/getDataGroup/${rfidGroup}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('nama_group').value = data.nama_group;
                        const mandorList = document.getElementById('mandor_list');
                        mandorList.innerHTML = ''; // Bersihkan daftar sebelumnya

                        data.nama_mandor.forEach(mandorName => {
                            const listItem = document.createElement('li');
                            listItem.textContent = mandorName;
                            mandorList.appendChild(listItem);
                        });
                    } else {
                        document.getElementById('nama_group').value = '';
                        document.getElementById('mandor_list').innerHTML = ''; // Bersihkan daftar jika error
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengambil data grup.');
                });
        });
    </script>
    <script>
        document.getElementById('rfid_tanaman').addEventListener('change', function() {
            const rfidTanaman = this.value;
            fetch(`<?= base_url('timbangan/getDataTanaman'); ?>/${rfidTanaman}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('nama_karyawan').value = data.nama_karyawan;
                        document.getElementById('npk').value = data.npk;
                        document.getElementById('pt_estate').value = data.pt_estate;
                        document.getElementById('nama_blok').value = data.nama_blok;
                        document.getElementById('status').value = data.status;
                        document.getElementById('sister').value = data.sister;
                        document.getElementById('no_titik_tanam').value = data.no_titik_tanam;
                        document.getElementById('tgl_identifikasi_tanaman').value = data
                            .tgl_identifikasi_tanaman || ''; // Tambahkan || ''
                        document.getElementById('tahun_tanam').value = data.tahun_tanam;
                        document.getElementById('bulan_tanam').value = data.bulan_tanam;
                        document.getElementById('luas_tanah').value = data.luas_tanah;
                        document.getElementById('varian_bibit').value = data.varian_bibit;
                    } else {
                        // Alert the user on error
                        alert(data.message);
                        // Clear all input fields
                        document.getElementById('nama_karyawan').value = '';
                        document.getElementById('npk').value = '';
                        document.getElementById('pt_estate').value = '';
                        document.getElementById('nama_blok').value = '';
                        document.getElementById('status').value = '';
                        document.getElementById('sister').value = '';
                        document.getElementById('no_titik_tanam').value = '';
                        document.getElementById('tgl_identifikasi_tanaman').value = '';
                        document.getElementById('tahun_tanam').value = '';
                        document.getElementById('bulan_tanam').value = '';
                        document.getElementById('luas_tanah').value = '';
                        document.getElementById('varian_bibit').value = '';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengambil data tanaman.');
                });
        });
    </script>
    <script>
        document.getElementById('submitTimbangan').addEventListener('click', function() {
            const rfidTanaman = document.getElementById('rfid_tanaman').value;
            const rfidGroup = document.getElementById('rfid_group').value;
            const beratTimbangan = document.getElementById('berat_timbangan').value;

            const formData = {
                rfid_tanaman: rfidTanaman,
                rfid_group: rfidGroup,
                berat_timbangan: beratTimbangan,
            };
            console.log(formData);
            fetch(`<?= base_url('timbangan/insertTimbanganData'); ?>`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data timbangan berhasil disimpan.');
                        window.location.reload();
                    } else {
                        alert('Gagal menyimpan data timbangan: ' + (data ? data.message :
                            'Terjadi kesalahan.'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data.');
                });
        });
    </script>
    <script>
        // disable Enter key on the Timbangan form
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('rfid_tanaman');
            form.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
</body>

</html>