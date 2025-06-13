<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Routes that require session authentication
// Routes that require session authentication
$routes->group('', ['filter' => 'authFilter'], function ($routes) {
    #--------------------------------------------------------------------
    # INDEX ADMIN
    #--------------------------------------------------------------------
    $routes->get('/admin/dashboard', 'AdminController::index');

    #--------------------------------------------------------------------
    # ADMIN MASTER LOKASI
    #--------------------------------------------------------------------
    $routes->get('/master-lokasi', 'MasterLokasiController::index'); // For HTML View
    $routes->get('/master-lokasi/data', 'MasterLokasiController::showAll'); // For JSON data
    $routes->get('/master-lokasi/data/(:segment)', 'MasterLokasiController::show/$1');

    $routes->get('/master-lokasi/add', 'MasterLokasiController::add'); // Add form view
    $routes->post('/master-lokasi/create', 'MasterLokasiController::create'); // Create action

    $routes->get('/master-lokasi/edit/(:segment)', 'MasterLokasiController::edit/$1'); // Edit form view
    $routes->post('/master-lokasi/update/(:segment)', 'MasterLokasiController::update/$1'); // Update action

    $routes->delete('/master-lokasi/(:segment)', 'MasterLokasiController::delete/$1'); // Delete action

    #--------------------------------------------------------------------
    # ADMIN MASTER KARYAWAN
    #--------------------------------------------------------------------
    $routes->get('/master-karyawan', 'MasterKaryawanController::index'); // For displaying all karyawan
    $routes->get('/master-karyawan/data', 'MasterKaryawanController::showAll'); // For JSON data
    $routes->get('/master-karyawan/data/(:segment)', 'MasterKaryawanController::show/$1');

    $routes->get('/master-karyawan/add', 'MasterKaryawanController::add'); // Add form view
    $routes->post('/master-karyawan/create', 'MasterKaryawanController::create'); // Create action

    $routes->get('/master-karyawan/edit/(:segment)', 'MasterKaryawanController::edit/$1'); // Edit form view
    $routes->post('/master-karyawan/update/(:segment)', 'MasterKaryawanController::update/$1'); // Update action

    $routes->delete('/master-karyawan/(:segment)', 'MasterKaryawanController::delete/$1'); // Delete action

    #--------------------------------------------------------------------
    # ADMIN GROUP KARYAWAN
    #--------------------------------------------------------------------
    $routes->get('/group-karyawan', 'GroupKaryawanController::index'); // For displaying all group karyawan
    $routes->get('/group-karyawan/data', 'GroupKaryawanController::showAll'); // For JSON data
    $routes->get('/group-karyawan/data/(:segment)', 'GroupKaryawanController::show/$1');

    $routes->get('/group-karyawan/add', 'GroupKaryawanController::add'); // Add form view
    $routes->post('/group-karyawan/create', 'GroupKaryawanController::create'); // Create action

    $routes->get('/group-karyawan/edit/(:segment)', 'GroupKaryawanController::edit/$1'); // Edit form view
    $routes->post('/group-karyawan/update/(:segment)', 'GroupKaryawanController::update/$1'); // Update action

    $routes->delete('/group-karyawan/(:segment)', 'GroupKaryawanController::delete/$1'); // Delete action

    #--------------------------------------------------------------------
    # ADMIN MEMBER GROUP KARYAWAN
    #--------------------------------------------------------------------
    $routes->get('/member-group/member/(:segment)', 'GroupMemberController::index/$1');
    $routes->get('/member-group/data', 'GroupMemberController::showAll'); // For JSON data
    $routes->get('/member-group/data/(:segment)', 'GroupMemberController::show/$1');

    $routes->get('/member-group/add', 'GroupMemberController::add'); // Add form view
    $routes->post('/member-group/create', 'GroupMemberController::create'); // Create action

    $routes->get('/member-group/edit/(:segment)', 'GroupMemberController::edit/$1'); // Edit form view
    $routes->post('/member-group/update/(:segment)', 'GroupMemberController::update/$1'); // Update action

    $routes->delete('/member-group/(:segment)', 'GroupMemberController::delete/$1'); // Delete action

    #--------------------------------------------------------------------
    # ADMIN MASTER USERS
    #--------------------------------------------------------------------
    $routes->get('/master-user', 'MasterUserController::index');
    $routes->get('/master-user/data', 'MasterUserController::showAll'); // For JSON data
    $routes->get('/master-user/data/(:segment)', 'MasterUserController::show/$1');

    $routes->get('/master-user/add', 'MasterUserController::add'); // Add form view
    $routes->post('/master-user/create', 'MasterUserController::create'); // Create action

    $routes->get('/master-user/edit/(:segment)', 'MasterUserController::edit/$1'); // Edit form view
    $routes->post('/master-user/update/(:segment)', 'MasterUserController::update/$1'); // Update action

    $routes->delete('/master-user/(:segment)', 'MasterUserController::delete/$1'); // Delete action

    #--------------------------------------------------------------------
    # ADMIN MASTER POLICY
    #--------------------------------------------------------------------
    $routes->get('/master-policy', 'MasterPolicyController::index');
    $routes->get('/master-policy/data', 'MasterPolicyController::showAll'); // For JSON data
    $routes->get('/master-policy/data/(:segment)', 'MasterPolicyController::show/$1');

    $routes->get('/master-policy/add', 'MasterPolicyController::add'); // Add form view
    $routes->post('/master-policy/create', 'MasterPolicyController::create'); // Create action

    $routes->get('/master-policy/edit/(:segment)', 'MasterPolicyController::edit/$1'); // Edit form view
    $routes->post('/master-policy/update/(:segment)', 'MasterPolicyController::update/$1'); // Update action

    $routes->delete('/master-policy/(:segment)', 'MasterPolicyController::delete/$1'); // Delete action

    #--------------------------------------------------------------------
    # ADMIN MASTER LOSSES
    #--------------------------------------------------------------------
    $routes->get('/master-losses', 'MasterLossesController::index');
    $routes->get('/master-losses/data', 'MasterLossesController::showAll'); // For JSON data
    $routes->get('/master-losses/data/(:segment)', 'MasterLossesController::show/$1');

    $routes->get('/master-losses/add', 'MasterLossesController::add'); // Add form view
    $routes->post('/master-losses/create', 'MasterLossesController::create'); // Create action

    $routes->get('/master-losses/edit/(:segment)', 'MasterLossesController::edit/$1'); // Edit form view
    $routes->post('/master-losses/update/(:segment)', 'MasterLossesController::update/$1'); // Update action

    $routes->delete('/master-losses/(:segment)', 'MasterLossesController::delete/$1'); // Delete action

    #--------------------------------------------------------------------
    # ADMIN MASTER PT ESTATE
    #--------------------------------------------------------------------
    $routes->get('/pt-estate', 'PtEstateController::index');
    $routes->get('/pt-estate/data', 'PtEstateController::showAll'); // For JSON data
    $routes->get('/pt-estate/data/(:segment)', 'PtEstateController::show/$1');

    $routes->get('/pt-estate/add', 'PtEstateController::add'); // Add form view
    $routes->post('/pt-estate/create', 'PtEstateController::create'); // Create action

    $routes->get('/pt-estate/edit/(:segment)', 'PtEstateController::edit/$1'); // Edit form view
    $routes->post('/pt-estate/update/(:segment)', 'PtEstateController::update/$1'); // Update action

    $routes->delete('/pt-estate/(:segment)', 'PtEstateController::delete/$1'); // Delete action

    #--------------------------------------------------------------------
    # ADMIN MASTER BLOCK
    #--------------------------------------------------------------------
    $routes->get('/master-blok', 'MasterBlokController::index');
    $routes->get('/master-blok/data', 'MasterBlokController::showAll'); // For JSON data
    $routes->get('/master-blok/data/(:segment)', 'MasterBlokController::show/$1');

    $routes->get('/master-blok/add', 'MasterBlokController::add'); // Add form view
    $routes->post('/master-blok/create', 'MasterBlokController::create'); // Create action

    $routes->get('/master-blok/edit/(:segment)', 'MasterBlokController::edit/$1'); // Edit form view
    $routes->post('/master-blok/update/(:segment)', 'MasterBlokController::update/$1'); // Update action

    $routes->delete('/master-blok/(:segment)', 'MasterBlokController::delete/$1'); // Delete action

    #--------------------------------------------------------------------
    # ADMIN MASTER STATUS
    #--------------------------------------------------------------------
    $routes->get('/master-status', 'MasterStatusController::index');
    $routes->get('/master-status/data', 'MasterStatusController::showAll'); // For JSON data
    $routes->get('/master-status/data/(:segment)', 'MasterStatusController::show/$1');

    $routes->get('/master-status/add', 'MasterStatusController::add'); // Add form view
    $routes->post('/master-status/create', 'MasterStatusController::create'); // Create action

    $routes->get('/master-status/edit/(:segment)', 'MasterStatusController::edit/$1'); // Edit form view
    $routes->post('/master-status/update/(:segment)', 'MasterStatusController::update/$1'); // Update action

    $routes->delete('/master-status/(:segment)', 'MasterStatusController::delete/$1'); // Delete action

    #--------------------------------------------------------------------
    # ADMIN HECTARE STATEMENT
    #--------------------------------------------------------------------
    $routes->get('/hectare-statement', 'HectareStatementController::index');
    $routes->get('/hectare-statement/data', 'HectareStatementController::showAll'); // For JSON data
    $routes->get('/hectare-statement/data/(:segment)', 'HectareStatementController::show/$1');

    $routes->get('/hectare-statement/add', 'HectareStatementController::add'); // Add form view
    $routes->post('/hectare-statement/create', 'HectareStatementController::create'); // Create action
    // Add a route for fetching Blok data based on PT Estate ID
    $routes->get('hectare-statement/get-bloks-by-pt-estate-id/(:num)', 'HectareStatementController::getBloksByPtEstateId/$1');

    $routes->get('/hectare-statement/edit/(:segment)', 'HectareStatementController::edit/$1'); // Edit form view
    $routes->post('/hectare-statement/update/(:segment)', 'HectareStatementController::update/$1'); // Update action

    $routes->delete('/hectare-statement/(:segment)', 'HectareStatementController::delete/$1'); // Delete action

    #--------------------------------------------------------------------
    # IDENTIFIKASI TANAMAN - NEW
    #--------------------------------------------------------------------
    $routes->get('/identifikasi-tanaman/new', 'IdentifikasiTanamanController::new');
    $routes->get('identifikasi-tanaman/getBloksByPtEstateId/(:num)', 'IdentifikasiTanamanController::getBloksByPtEstateId/$1');
    $routes->get('identifikasi-tanaman/getHectareStatementByPtEstateIdAndBlockId/(:num)/(:num)', 'IdentifikasiTanamanController::getHectareStatementByPtEstateIdAndBlockId/$1/$2');
    $routes->get('identifikasi-tanaman/getNoTitikTanamData/(:num)/(:num)/(:num)', 'IdentifikasiTanamanController::getNoTitikTanamData/$1/$2/$3');
    $routes->get('identifikasi-tanaman/getTanamanStatus/(:segment)/(:segment)/(:segment)/(:segment)/(:segment)', 'IdentifikasiTanamanController::getTanamanStatus/$1/$2/$3/$4/$5');
    $routes->get('identifikasi-tanaman/fetchSister/(:segment)/(:segment)/(:segment)', 'IdentifikasiTanamanController::fetchSister/$1/$2/$3');
    $routes->post('identifikasi-tanaman/insertTanamanData', 'IdentifikasiTanamanController::insertTanamanData');

    #--------------------------------------------------------------------
    # IDENTIFIKASI TANAMAN - UPDATE
    #--------------------------------------------------------------------
    $routes->get('identifikasi-tanaman/update', 'IdentifikasiTanamanController::viewEdit');
    $routes->get('identifikasi-tanaman/getActiveTanamanData/(:num)', 'IdentifikasiTanamanController::getActiveTanamanData/$1');
    $routes->get('identifikasi-tanaman/getLossesOptions', 'IdentifikasiTanamanController::getLossesOptions');
    $routes->post('identifikasi-tanaman/updateIdentifikasiTanaman', 'IdentifikasiTanamanController::updateIdentifikasiTanaman');

    #--------------------------------------------------------------------
    # TIMBANGAN
    #--------------------------------------------------------------------
    $routes->get('timbangan', 'TimbanganController::index');
    $routes->get('timbangan/getDataGroup/(:segment)', 'TimbanganController::getDataGroup/$1');
    $routes->get('timbangan/getDataTanaman/(:segment)', 'TimbanganController::getDataTanaman/$1');
    $routes->post('timbangan/insertTimbanganData', 'TimbanganController::insertTimbanganData');

    #--------------------------------------------------------------------
    # LAPORAN PANEN BULANAN
    #--------------------------------------------------------------------
    $routes->get('laporan/panen-bulanan', 'LaporanController::laporanPanenBulanan');
    $routes->get('laporan/fetchReportData', 'LaporanController::fetchReportData');
    $routes->get('laporan/panen-bulanan/downloadExcel', 'LaporanController::downloadPanenBulananExcel');
    $routes->get('laporan/panen-bulanan/downloadPdf',   'LaporanController::downloadPanenBulananPdf');


    #--------------------------------------------------------------------
    # LAPORAN PREDIKSI PANEN
    #--------------------------------------------------------------------

    $routes->get('laporan/penentuan-masa-panen', 'LaporanController::laporanPrediksiPanen');
    $routes->get('laporan/penentuan-masa-panen/getPolicies', 'LaporanController::getPolicies');
    $routes->get('laporan/penentuan-masa-panen/getBloksByPtEstateId/(:num)', 'LaporanController::getBloksByPtEstateId/$1');
    $routes->get('laporan/penentuan-masa-panen/getHectareStatementByPtEstateIdAndBlockId/(:num)/(:num)', 'LaporanController::getHectareStatementByPtEstateIdAndBlockId/$1/$2');
    $routes->get('laporan/penentuan-masa-panen/data', 'LaporanController::fetchPrediksiData');
    $routes->get('laporan/penentuan-masa-panen/data-all', 'LaporanController::fetchAllPrediksiData');
    $routes->get('laporan/penentuan-masa-panen/downloadExcel',    'LaporanController::downloadPrediksiPanenExcel');
    $routes->get('laporan/penentuan-masa-panen/downloadPdf',      'LaporanController::downloadPrediksiPanenPdf');
    $routes->get('laporan/penentuan-masa-panen/downloadAllExcel', 'LaporanController::downloadAllPrediksiPanenExcel');
    $routes->get('laporan/penentuan-masa-panen/downloadAllPdf',   'LaporanController::downloadAllPrediksiPanenPdf');


    #--------------------------------------------------------------------
    # LAPORAN HISTORY LOSSES
    #--------------------------------------------------------------------

    $routes->get('laporan/history-losses', 'LaporanController::laporanHistoryLosses');
    $routes->get('laporan/history-losses/data', 'LaporanController::fetchHistoryLossesReport');
    $routes->get('laporan/history-losses/data-all', 'LaporanController::fetchAllHistoryLossesReport');
    $routes->get('laporan/history-losses/downloadExcel', 'LaporanController::downloadHistoryLossesExcel');
    $routes->get('laporan/history-losses/downloadPdf',   'LaporanController::downloadHistoryLossesPdf');


    #--------------------------------------------------------------------
    # LOG OUT
    #--------------------------------------------------------------------
    $routes->get('/logout', 'AuthController::logout');
});

#--------------------------------------------------------------------
# ANDROID
#--------------------------------------------------------------------
$routes->post('/login-process-android', 'AndroidController::loginProcessAndroid');
$routes->post('android/download', 'AndroidController::download');
$routes->get('android/update', 'AndroidController::download/$1');

#--------------------------------------------------------------------
# WEBSITE
#--------------------------------------------------------------------
$routes->get('/', 'AuthController::login');
$routes->get('/auth-login', 'AuthController::login');
$routes->get('/auth-register', 'AuthController::register');
$routes->post('/register-process', 'AuthController::registerProcess');
$routes->post('/login-process', 'AuthController::loginProcess');

$routes->get('/test', 'TestController::index');
