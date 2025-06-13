<?php
$request = \Config\Services::request();
$currentUri1 = $request->getUri()->getSegment(1);
$currentUri2 = $request->getUri()->getSegment(2);
?>


<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="#"><img src=".../public/assets/Image/icon.png" alt="Logo" srcset="" /></a>
                </div>
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer" />
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item active">
                <li
                    class="sidebar-item <?= ($currentUri1 === 'admin' && $currentUri2 === 'dashboard') ? 'active' : ''; ?>">
                    <a href="<?= base_url('admin/dashboard'); ?>" class="sidebar-link">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li
                    class="sidebar-item has-sub <?= in_array($currentUri1, ['master-lokasi', 'master-karyawan', 'group-karyawan', 'master-user', 'master-policy', 'master-losses', 'pt-estate', 'master-blok', 'member-group', 'master-status']) ? 'active' : ''; ?>">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item <?= ($currentUri1 === 'master-lokasi') ? 'active' : ''; ?>">
                            <a href="<?= base_url('master-lokasi'); ?>" class="submenu-link">Master Lokasi</a>
                        </li>
                        <li class="submenu-item <?= ($currentUri1 === 'master-karyawan') ? 'active' : ''; ?>">
                            <a href="<?= base_url('master-karyawan'); ?>" class="submenu-link">Master Karyawan</a>
                        </li>
                        <li
                            class="submenu-item <?= ($currentUri1 === 'group-karyawan' or $currentUri1 === 'member-group') ? 'active' : ''; ?>">
                            <a href="<?= base_url('group-karyawan'); ?>" class="submenu-link">Group Karyawan</a>
                        </li>
                        <li class="submenu-item <?= ($currentUri1 === 'master-user') ? 'active' : ''; ?>">
                            <a href="<?= base_url('master-user'); ?>" class="submenu-link">Master Users</a>
                        </li>
                        <li class="submenu-item <?= ($currentUri1 === 'master-policy') ? 'active' : ''; ?>">
                            <a href="<?= base_url('master-policy'); ?>" class="submenu-link">Master Policy</a>
                        </li>
                        <li class="submenu-item <?= ($currentUri1 === 'master-losses') ? 'active' : ''; ?>">
                            <a href="<?= base_url('master-losses'); ?>" class="submenu-link">Master Losses</a>
                        </li>
                        <li class="submenu-item <?= ($currentUri1 === 'pt-estate') ? 'active' : ''; ?>">
                            <a href="<?= base_url('pt-estate'); ?>" class="submenu-link">Master PT dan Estate</a>
                        </li>
                        <li class="submenu-item <?= ($currentUri1 === 'master-blok') ? 'active' : ''; ?>">
                            <a href="<?= base_url('master-blok'); ?>" class="submenu-link">Master Block</a>
                        </li>
                        <li class="submenu-item <?= ($currentUri1 === 'master-status') ? 'active' : ''; ?>">
                            <a href="<?= base_url('master-status'); ?>" class="submenu-link">Master Status</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item <?= ($currentUri1 === 'hectare-statement') ? 'active' : ''; ?>">
                    <a href="<?= base_url('hectare-statement'); ?>" class="sidebar-link">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Hectare Statement</span>
                    </a>
                </li>
                <li
                    class="sidebar-item has-sub <?= in_array($currentUri1, ['identifikasi-tanaman']) ? 'active' : ''; ?>">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-clipboard-plus-fill"></i>
                        <span>Identifikasi Tanaman</span>
                    </a>
                    <ul class="submenu">
                        <li
                            class="submenu-item <?= ($currentUri1 === 'identifikasi-tanaman' && $currentUri2 === 'new') ? 'active' : ''; ?>">
                            <a href="<?= base_url('identifikasi-tanaman/new'); ?>" class="submenu-link">New</a>
                        </li>
                        <li
                            class="submenu-item <?= ($currentUri1 === 'identifikasi-tanaman' && $currentUri2 === 'update') ? 'active' : ''; ?>">
                            <a href="<?= base_url('identifikasi-tanaman/update'); ?>" class="submenu-link">Update</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item <?= in_array($currentUri1, ['timbangan']) ? 'active' : ''; ?>">
                    <a href="<?= base_url('timbangan'); ?>" class="sidebar-link">
                        <i class="bi bi-calculator-fill"></i>
                        <span>Timbangan</span>
                    </a>
                </li>
                <li class="sidebar-item has-sub <?= in_array($currentUri1, ['laporan']) ? 'active' : ''; ?>">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Laporan</span>
                    </a>
                    <ul class="submenu">
                        <li
                            class="submenu-item <?= ($currentUri1 === 'laporan' && $currentUri2 === 'panen-bulanan') ? 'active' : ''; ?>">
                            <a href="<?= base_url('laporan/panen-bulanan'); ?>" class="submenu-link">Laporan Panen
                                Bulanan</a>
                        </li>
                        <li
                            class="submenu-item <?= ($currentUri1 === 'laporan' && $currentUri2 === 'penentuan-masa-panen') ? 'active' : ''; ?>">
                            <a href="<?= base_url('laporan/penentuan-masa-panen'); ?>" class="submenu-link">Penentuan
                                Masa Panen</a>
                        </li>
                        <li
                            class="submenu-item <?= ($currentUri1 === 'laporan' && $currentUri2 === 'history-losses') ? 'active' : ''; ?>">
                            <a href="<?= base_url('laporan/history-losses'); ?>" class="submenu-link">History
                                Losses</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="<?= base_url('logout'); ?>" class="sidebar-link">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>