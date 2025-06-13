<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>

    <link rel="shortcut icon" href="../assets/compiled/svg/favicon.svg" type="image/x-icon" />
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png" />

    <link rel="stylesheet" href="../assets/compiled/css/app.css" />
    <link rel="stylesheet" href="../assets/compiled/css/app-dark.css" />
    <link rel="stylesheet" href="../assets/compiled/css/iconly.css" />
    <style>
        #chart-panen-perbulan {
            width: 100%;
            height: 350px;
        }

        #chart-losses-perbulan {
            width: 100%;
            height: 350px;
            margin-top: 1rem;
            /* beri sedikit jarak dari chart panen */
        }

        @media (max-width: 768px) {

            #chart-panen-perbulan,
            #chart-losses-perbulan {
                height: 250px;
            }
        }

        /* Mengurangi jarak di user‐profile card (opsional) */
        .card-body.px-4 ul li {
            margin-bottom: 0.4rem;
        }

        .card-body.px-4 hr {
            margin: 0.5rem 0;
        }
    </style>
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <?= view('sidebar'); ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Dashboard</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <!-- Card 1: Jumlah Karyawan -->
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                <div class="stats-icon purple mb-2">
                                                    <i class="iconly-boldUser"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">
                                                    Jumlah Karyawan
                                                </h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?= number_format($jumlahKaryawan, 0, ',', '.'); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2: Jumlah Tanaman Aktif -->
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                <div class="stats-icon green mb-2">
                                                    <i class="iconly-boldTick-Square"></i>
                                                </div>
                                            </div>

                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">
                                                    Jumlah Tanaman Aktif
                                                </h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?= number_format($jumlahTanamanAktif, 0, ',', '.'); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3: Tanaman yang telah panen di tahun ini -->
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                <div class="stats-icon green mb-2">
                                                    <i class="iconly-boldTick-Square"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">
                                                    Tanaman Panen (<?= $currentYear ?>)
                                                </h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?= number_format($jumlahPanenThisYear, 0, ',', '.'); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4: Tanaman yang losses -->
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                <div class="stats-icon red mb-2">
                                                    <i class="iconly-boldClose-Square"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">
                                                    Tanaman Losses (<?= $currentYear ?>)
                                                </h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?= number_format($jumlahLossesThisYear, 0, ',', '.'); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h4>Jumlah Panen per Bulan</h4>
                                        <small class="text-muted">Tahun <?= esc($currentYear) ?></small>
                                    </div>
                                    <div class="card-body">
                                        <!-- Wadah chart -->
                                        <div id="chart-panen-perbulan"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h4>Tanaman Losses per Bulan</h4>
                                        <small class="text-muted">Tahun <?= esc($currentYear) ?></small>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-losses-perbulan"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>User Profile</h4>
                            </div>
                            <!-- Kurangi padding vertical dari py-4 menjadi py-2 -->
                            <div class="card-body px-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <?php if (isset($karyawan['gender']) && $karyawan['gender'] === 'L'): ?>
                                            <img src="https://media-public.canva.com/rVvfU/MAFlPzrVvfU/1/t.png"
                                                alt="Avatar Pria" />
                                        <?php elseif (isset($karyawan['gender']) && $karyawan['gender'] === 'P'): ?>
                                            <img src="https://media-public.canva.com/C2C40/MAFlP9C2C40/1/t.png"
                                                alt="Avatar Wanita" />
                                        <?php else: ?>
                                            <img src="<?= base_url('assets/static/images/avatar-placeholder.png') ?>"
                                                alt="Avatar Default" />
                                        <?php endif ?>
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold"><?= esc($karyawan['nama']) ?></h5>
                                    </div>
                                </div>

                                <!-- Ganti my-3 menjadi my-2 agar jarak lebih kecil -->
                                <hr class="my-3">

                                <ul class="list-unstyled">
                                    <li>
                                        <strong>NPK:</strong>
                                        <span class="text-muted"><?= esc($karyawan['npk']) ?></span>
                                    </li>
                                    <li>
                                        <strong>Nama:</strong>
                                        <span class="text-muted"><?= esc($karyawan['nama']) ?></span>
                                    </li>
                                    <li>
                                        <strong>Status Karyawan:</strong>
                                        <span class="text-muted"><?= esc($karyawan['status_karyawan']) ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?= view('footer'); ?>
        </div>
    </div>
    <script src="../assets/static/js/components/dark.js"></script>
    <script src="../assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../assets/compiled/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="../assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/static/js/pages/dashboard.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Data Panen dari PHP ---
            const panenData = <?= json_encode($panenCounts) ?>;
            const panenLabels = <?= json_encode($panenLabels) ?>;

            const optionsPanen = {
                chart: {
                    type: 'bar',
                    width: '100%',
                    height: '100%',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Jumlah Panen',
                    data: panenData
                }],
                xaxis: {
                    categories: panenLabels
                },
                yaxis: {
                    title: {
                        text: ''
                    },
                    min: 0,
                    labels: {
                        show: false
                    }, // sembunyikan label Y jika perlu
                    axisBorder: {
                        show: false
                    }, // opsi: sembunyikan garis tenggorokan Y
                    axisTicks: {
                        show: false
                    } // opsi: sembunyikan tanda tick Y
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    opacity: 0.8
                },
                colors: ['#435ebe'],
                responsive: [{
                    breakpoint: 768,
                    options: {
                        chart: {
                            height: 250
                        }
                    }
                }]
            };

            const chartPanen = new ApexCharts(
                document.querySelector('#chart-panen-perbulan'),
                optionsPanen
            );
            chartPanen.render();

            // --- Data Losses dari PHP ---
            const lossesData = <?= json_encode($lossesCounts) ?>;
            const lossesLabels = panenLabels; // label bulan sama

            const optionsLosses = {
                chart: {
                    type: 'bar',
                    width: '100%',
                    height: '100%',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Tanaman Losses',
                    data: lossesData
                }],
                xaxis: {
                    categories: lossesLabels
                },
                yaxis: {
                    title: {
                        text: ''
                    },
                    min: 0,
                    labels: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    opacity: 0.8
                },
                colors: ['#dc3545'], // warna merah untuk losses
                responsive: [{
                    breakpoint: 768,
                    options: {
                        chart: {
                            height: 250
                        }
                    }
                }]
            };

            const chartLosses = new ApexCharts(
                document.querySelector('#chart-losses-perbulan'),
                optionsLosses
            );
            chartLosses.render();
        });
    </script>
</body>

</html>