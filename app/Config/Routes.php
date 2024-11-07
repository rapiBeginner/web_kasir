<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/produk', 'ProdukController::index');
$routes->get('/produk/tampil', 'ProdukController::tampil');
$routes->post('/produk/tambah', 'ProdukController::simpan');
$routes->post('/produk/hapus', 'ProdukController::hapus');
$routes->post('/produk/edit', 'ProdukController::edit');

