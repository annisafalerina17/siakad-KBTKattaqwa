<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// AUTH
$routes->get('/', 'AuthController::index');
$routes->get('/register', 'AuthController::registerPage');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/delete/(:num)', 'AuthController::delete/$1');
$routes->post('/register', 'AuthController::register');
$routes->post('/login', 'AuthController::login');
$routes->post('/resetPassword', 'AuthController::resetPassword');
$routes->post('/editBiodataGuru', 'AuthController::editBiodataGuru');
$routes->post('/editBiodataSiswa', 'AuthController::editBiodataSiswa');
$routes->post('/editRegGuru', 'AuthController::editRegGuru');
$routes->post('/editRegSiswa', 'AuthController::editRegSiswa');

// ADMIN, STAFF, GURU
$routes->get('/admin/dashboard', 'AdminController::index');
$routes->get('/admin/profil', 'AdminController::profil');
$routes->get('/admin/dataGuru', 'AdminController::dataGuru');
// $routes->get('/admin/profilGuru/(:num)', 'AdminController::profilGuru/$1');
$routes->get('/admin/dataSiswa', 'AdminController::dataSiswa');
// $routes->get('/admin/profilSiswa/(:num)', 'AdminController::profilSiswa/$1');
$routes->get('/admin/pembagianGuruKelas', 'AdminController::pembagianGuruKelas');
$routes->get('/admin/pembagianGuruKelasGuru', 'AdminController::pembagianGuruKelasGuru');
$routes->get('/admin/anggotaKelas/(:num)', 'AdminController::anggotaKelas/$1');
$routes->get('/admin/deleteAnggotaKelas/(:num)', 'AdminController::deleteAnggotaKelas/$1');
$routes->get('/admin/jadwalEkstrakurikuler', 'AdminController::jadwalEkstrakurikuler');
$routes->get('/admin/deleteJadwalEkstrakurikuler/(:num)', 'AdminController::deleteJadwalEkstrakurikuler/$1');
$routes->get('/admin/laporanPerkembangan', 'AdminController::laporanPerkembangan');
$routes->get('/admin/detailLppd/(:num)/(:any)', 'AdminController::detailLppd/$1/$2');
$routes->get('/admin/deleteLppd/(:num)', 'AdminController::deleteLppd/$1');
$routes->get('/admin/pendaftarEkstrakurikuler', 'AdminController::pendaftarEkstrakurikuler');
$routes->post('/admin/tambahAnggotaKelas', 'AdminController::tambahAnggotaKelas');
$routes->post('/admin/tambahJadwalEkstrakurikuler', 'AdminController::tambahJadwalEkstrakurikuler');
$routes->post('/admin/editJadwalEkstrakurikuler', 'AdminController::editJadwalEkstrakurikuler');
$routes->post('/admin/tambahLppd', 'AdminController::tambahLppd');

// SISWA
$routes->get('/siswa/profil', 'SiswaController::profil');
$routes->get('/siswa/pembagianGuruKelasSiswa', 'SiswaController::pembagianGuruKelasSiswa');
$routes->get('/siswa/detailLppd/(:num)', 'SiswaController::detailLppd/$1');
$routes->get('/siswa/jadwalEkstrakurikuler', 'SiswaController::jadwalEkstrakurikuler');
$routes->get('/siswa/daftarEkstrakurikuler', 'SiswaController::daftarEkstrakurikuler');
$routes->get('/siswa/keluarEkstrakurikuler/(:num)/(:num)', 'SiswaController::keluarEkstrakurikuler/$1/$2');
$routes->post('/siswa/masukEkstrakurikuler', 'SiswaController::masukEkstrakurikuler');
