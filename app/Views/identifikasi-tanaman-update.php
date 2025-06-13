<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Identifikasi Tanaman - Update</title>

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
                            <h3>Identifikasi Tanaman Update</h3>
                            <p class="text-subtitle text-muted">
                                Form untuk mengupdate data tanaman
                            </p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Identifikasi Tanaman
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <form class="form" id="form-identifikasi-tanaman-update">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Karyawan</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="npk">NPK</label>
                                    <input type="text" id="npk" class="form-control" name="npk"
                                        value="<?= isset($npk) ? $npk : ''; ?>" readonly />
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Karyawan</label>
                                    <input type="text" id="nama" class="form-control" name="nama"
                                        value="<?= isset($nama) ? $nama : ''; ?>" readonly />
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="multiple-column-form">

                        <div class="row match-height">
                            <!-- Card for Hectar Statement Data -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Data Hectar Statement</h4>
                                        <p>Masukkan Data Hectar Statement</p>
                                    </div>
                                    <div class="card-body">
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
                                                    <input type="text" id="week" class="form-control" name="week"
                                                        readonly />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <!-- Tahun Tanam -->
                                                <div class="form-group">
                                                    <label for="tahun_tanam">Tahun Tanam</label>
                                                    <input type="text" id="tahun_tanam" class="form-control"
                                                        name="tahun_tanam" readonly />
                                                </div>

                                                <!-- Bulan Tanam -->
                                                <div class="form-group">
                                                    <label for="bulan_tanam">Bulan Tanam</label>
                                                    <input type="text" id="bulan_tanam" class="form-control"
                                                        name="bulan_tanam" readonly />
                                                </div>

                                                <!-- Luas Tanah (Ha) -->
                                                <div class="form-group">
                                                    <label for="luas_tanah">Luas Tanah (Ha)</label>
                                                    <input type="text" id="luas_tanah" class="form-control"
                                                        name="luas_tanah" readonly />
                                                </div>

                                                <!-- Varian Bibit -->
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

                            <!-- Card for Identifikasi Tanaman Data -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Mencari Data Identifikasi Tanaman</h4>
                                        <p>Masukkan No Titik Tanam</p>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="no_titik_tanam">No Titik Tanam</label>
                                            <input type="text" id="no_titik_tanam" class="form-control"
                                                name="no_titik_tanam" />
                                        </div>
                                        <div class="form-group">
                                            <label for="longitude">Titik Tanaman Longitude</label>
                                            <input type="text" id="longitude" class="form-control" name="longitude" />
                                        </div>
                                        <div class="form-group">
                                            <label for="latitude">Titik Tanaman Latitude</label>
                                            <input type="text" id="latitude" class="form-control" name="latitude" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="tanaman-container">
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>

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
        // Function to fetch blocks when a PT & Estate is selected
        function updateBloks() {
            const ptEstateId = document.getElementById('pt_estate').value;
            const blokSelect = document.getElementById('blok_id');

            if (ptEstateId) {
                fetch(`<?= base_url('identifikasi-tanaman/getBloksByPtEstateId'); ?>/${ptEstateId}`)
                    .then(response => response.json())
                    .then(data => {
                        blokSelect.innerHTML = '<option value="">Select Blok</option>'; // Reset blok options
                        data.bloks.forEach(blok => {
                            const option = document.createElement('option');
                            option.value = blok.blok_id;
                            option.textContent = blok.nama_blok;
                            blokSelect.appendChild(option);
                        });

                        // Auto-fill fields after fetching blocks
                        autoFillFields();
                    })
                    .catch(error => console.error('Error fetching blocks:', error));
            } else {
                blokSelect.innerHTML = '<option value="">Select Blok</option>'; // Reset blok if no PT selected
            }
        }

        // Function to auto-fill the fields when a blok is selected
        function autoFillFields() {
            const ptEstateId = document.getElementById('pt_estate').value;
            const blokId = document.getElementById('blok_id').value;

            if (ptEstateId && blokId) {
                fetch(
                        `<?= base_url('identifikasi-tanaman/getHectareStatementByPtEstateIdAndBlockId'); ?>/${ptEstateId}/${blokId}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            document.getElementById('tahun_tanam').value = data.tahun_tanam;
                            document.getElementById('bulan_tanam').value = data.bulan_tanam;
                            document.getElementById('luas_tanah').value = data.luas_tanah;
                            document.getElementById('varian_bibit').value = data.varian_bibit;
                            document.getElementById('week').value = data.week; // Auto-fill week
                        }
                    })
                    .catch(error => console.error('Error fetching hectare statement data:', error));
            }
        }

        // Function to auto-fill longitude and latitude if no titik tanam is inputed
        function autoFillTitikTanam() {
            const noTitikTanam = document.getElementById('no_titik_tanam').value;
            const ptEstateId = document.getElementById('pt_estate')
                .value;
            const blokId = document.getElementById('blok_id').value;
            const longitudeField = document.getElementById('longitude');
            const latitudeField = document.getElementById('latitude');

            if (noTitikTanam && ptEstateId && blokId) {
                fetch(
                        `<?= base_url('identifikasi-tanaman/getNoTitikTanamData'); ?>/${noTitikTanam}/${ptEstateId}/${blokId}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        if (data.found) {
                            // If data found, populate fields and make them read-only
                            document.getElementById('longitude').value = data.longitude;
                            document.getElementById('latitude').value = data.latitude;
                            longitudeField.readOnly = true;
                            latitudeField.readOnly = true;
                        } else {
                            // If no data found, keep fields editable
                            longitudeField.readOnly = false;
                            latitudeField.readOnly = false;
                        }
                    })
                    .catch(error => console.error('Error fetching No Titik Tanam data:', error));
            } else {
                // Reset fields if no Titik Tanam or required fields are provided
                longitudeField.readOnly = false;
                latitudeField.readOnly = false;
                longitudeField.value = '';
                latitudeField.value = '';
            }
        }

        // Add event listener to fetch data when block is selected
        document.getElementById('blok_id').addEventListener('change', autoFillFields);
        // Add event listener to the No Titik Tanam input field
        document.getElementById('no_titik_tanam').addEventListener('change', autoFillTitikTanam);

        // Function to auto-fill the fields when a no_titik_tanam is provided
        function autoFillTanamanData() {
            const noTitikTanam = document.getElementById('no_titik_tanam').value;
            const tanamanContainer = document.getElementById('tanaman-container');

            if (noTitikTanam) {
                fetch(`<?= base_url('identifikasi-tanaman/getActiveTanamanData'); ?>/${noTitikTanam}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Clear any existing tanaman fields
                            tanamanContainer.innerHTML = '';

                            // Loop through each active tanaman and create a new form section for it
                            data.tanaman.forEach((tanaman, index) => {
                                const formHtml = `
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tanaman ${index + 1}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>RFID</label>
                                                <input type="text" class="form-control" name="rfid_tanaman[${index}]"
                                                    id="rfid_tanaman_${index}" value="${tanaman.rfid_tanaman}" readonly />
                                            </div>
                                            <div class="form-group">
                                                <label>Update RFID?</label>
                                                <input type="checkbox" class="form-check-input" id="update_rfid_${index}" onchange="toggleNewRfid(${index})" />
                                                <div id="updateRfidFields_${index}" style="display: none;">
                                                    <input type="text" class="form-control" name="new_rfid[${index}]"
                                                        id="update_rfid_tanaman_${index}" placeholder="Enter new RFID" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Sister</label>
                                                <input type="text" class="form-control" name="sister[${index}]"
                                                    id="sister_${index}" value="${tanaman.sister}" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <input type="text" class="form-control" name="status[${index}]"
                                                    id="status_tanaman_${index}" value="${tanaman.nama_status}" readonly />
                                            </div>
                                            <div class="form-group">
                                                <label>Update Losses?</label>
                                                <input type="checkbox" class="form-check-input" id="update_losses_${index}" onchange="toggleLossesFields(${index})" />
                                                <div id="lossesFields_${index}" style="display: none;">
                                                    <select class="form-select" name="penyebab_loses[${index}]" id="penyebab_loses_${index}">
                                                        <option>Select Penyebab Loses</option>
                                                    </select>
                                                    <br>
                                                    <textarea class="form-control" name="deskripsi_loses[${index}]"
                                                        placeholder="Isi Deskripsi Penyebab Loses"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                                tanamanContainer.innerHTML += formHtml;

                                // Fetch and populate losses dropdown after form is generated
                                fetchLossesOptions(index);
                            });
                        } else {
                            alert(data.error || 'No active tanaman found');
                        }
                    })
                    .catch(error => console.error('Error fetching active tanaman data:', error));
            }
        }

        // Fetch Master Losses and populate the dropdown
        function fetchLossesOptions(index) {
            fetch(`<?= base_url('identifikasi-tanaman/getLossesOptions') ?>`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const lossesSelect = document.getElementById(`penyebab_loses_${index}`);
                        data.losses.forEach(loss => {
                            const option = document.createElement("option");
                            option.value = loss.losses_id;
                            option.text = loss.penyebab_losses;
                            lossesSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error fetching losses options:', error));
        }

        // Toggle RFID input field visibility
        function toggleNewRfid(index) {
            const checkbox = document.getElementById(`update_rfid_${index}`);
            const newRfidFields = document.getElementById(`updateRfidFields_${index}`);
            newRfidFields.style.display = checkbox.checked ? 'block' : 'none';
        }

        // Toggle losses fields visibility
        function toggleLossesFields(index) {
            const checkbox = document.getElementById(`update_losses_${index}`);
            const lossesFields = document.getElementById(`lossesFields_${index}`);
            lossesFields.style.display = checkbox.checked ? 'block' : 'none';
        }

        // Add event listener to the No Titik Tanam input field
        document.getElementById('no_titik_tanam').addEventListener('change', function() {
            // Clear existing fields when No Titik Tanam is cleared
            if (!this.value) {
                document.getElementById('tanaman-container').innerHTML = '';
            }
            autoFillTanamanData();
        });
        document.getElementById('form-identifikasi-tanaman-update').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(this); // Create FormData object from the form

            fetch('<?= base_url('identifikasi-tanaman/updateIdentifikasiTanaman'); ?>', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message); // Show success message
                        window.location.reload();
                    } else {
                        alert(data.message); // Show error message
                    }
                })
                .catch(error => {
                    console.error('Error submitting form:', error);
                    alert('An error occurred during submission.');
                });
        });
    </script>
    <script>
        // disable Enter on update form
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('form-identifikasi-tanaman-update');
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