<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'config/Routes.php')) {
    require SYSTEMPATH . 'config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/Home', 'Home::home');
$routes->get('/Dashboard', 'Users::index');
$routes->post('/Dashboard', 'Users::index');
$routes->get('/user', 'Home::index');
$routes->get('/view_profile', 'Users::view_profile');

$routes->get('/transaksi/export', 'Home::export');

$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->post('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/create', 'Admin::create', ['filter' => 'role:admin']);
$routes->get('/admin/(:num)', 'Admin::detail/$1', ['filter' => 'role:admin']);
$routes->post('/admin/(:num)', 'Admin::update/$1', ['filter' => 'role:admin']);
$routes->get('/admin/edit/(:any)', 'Admin::edit/$1', ['filter' => 'role:admin']);
$routes->get('/admin/delete/(:num)', 'Admin::delete/$1', ['filter' => 'role:admin']);
$routes->get('/edit_my_admin', 'Admin::edit_my_admin', ['filter' => 'role:admin']);
$routes->get('/admin/change-password/(:num)', 'Admin::changePassword/$1', ['filter' => 'role:admin']);
$routes->post('/admin/update-password/(:num)', 'Admin::updatePassword/$1', ['filter' => 'role:admin']);

$routes->get('/admin/bookings', 'Booking::listAdminBookings', ['filter' => 'role:admin']);
$routes->post('/admin/bookings', 'Booking::listAdminBookings', ['filter' => 'role:admin']);
$routes->get('/admin/detail/bookings/(:any)', 'Booking::detailAdminBookings/$1', ['filter' => 'role:admin']);
$routes->post('/admin/detail/bookings/confirm/(:any)', 'Booking::confirmAdminBookings/$1', ['filter' => 'role:admin']);
$routes->post('/admin/detail/bookings/return/(:any)', 'Booking::returnAdminBookings/$1', ['filter' => 'role:admin']);

$routes->get('/admin/products', 'Admin::listProducts', ['filter' => 'role:admin']);
$routes->post('/admin/products', 'Admin::listProducts', ['filter' => 'role:admin']);
$routes->get('/admin/create/products', 'Admin::createProducts', ['filter' => 'role:admin']);
$routes->post('/admin/save/products', 'Admin::saveProducts', ['filter' => 'role:admin']);
$routes->delete('/admin/products/(:num)', 'Admin::deleteProducts/$1', ['filter' => 'role:admin']);
$routes->get('/admin/products/(:any)', 'Admin::editProducts/$1', ['filter' => 'role:admin']);
$routes->post('/admin/products/(:any)', 'Admin::updateProducts/$1', ['filter' => 'role:admin']);

$routes->get('/admin/categories', 'Admin::listCategories', ['filter' => 'role:admin']);
$routes->post('/admin/categories', 'Admin::listCategories', ['filter' => 'role:admin']);
$routes->get('/admin/create/categories', 'Admin::createCategories', ['filter' => 'role:admin']);
$routes->post('/admin/save/categories', 'Admin::saveCategories', ['filter' => 'role:admin']);
$routes->delete('/admin/categories/(:num)', 'Admin::deleteCategories/$1', ['filter' => 'role:admin']);
$routes->get('/admin/categories/(:any)', 'Admin::editCategories/$1', ['filter' => 'role:admin']);
$routes->post('/admin/categories/(:any)', 'Admin::updateCategories/$1', ['filter' => 'role:admin']);

$routes->get('/admin/suppliers', 'Admin::listSuppliers', ['filter' => 'role:admin']);
$routes->post('/admin/suppliers', 'Admin::listSuppliers', ['filter' => 'role:admin']);
$routes->get('/admin/create/suppliers', 'Admin::createSuppliers', ['filter' => 'role:admin']);
$routes->post('/admin/save/suppliers', 'Admin::saveSuppliers', ['filter' => 'role:admin']);
$routes->delete('/admin/suppliers/(:num)', 'Admin::deleteSuppliers/$1', ['filter' => 'role:admin']);
$routes->get('/admin/suppliers/(:any)', 'Admin::editSuppliers/$1', ['filter' => 'role:admin']);
$routes->post('/admin/suppliers/(:any)', 'Admin::updateSuppliers/$1', ['filter' => 'role:admin']);

$routes->get('/admin/services', 'Admin::listServices', ['filter' => 'role:admin']);
$routes->post('/admin/services', 'Admin::listServices', ['filter' => 'role:admin']);
$routes->get('/admin/create/services', 'Admin::createServices', ['filter' => 'role:admin']);
$routes->post('/admin/save/services', 'Admin::saveServices', ['filter' => 'role:admin']);
$routes->delete('/admin/services/(:num)', 'Admin::deleteServices/$1', ['filter' => 'role:admin']);
$routes->get('/admin/services/(:any)', 'Admin::editServices/$1', ['filter' => 'role:admin']);
$routes->post('/admin/services/(:any)', 'Admin::updateServices/$1', ['filter' => 'role:admin']);

$routes->get('/user', 'Users::index', ['filter' => 'role:user']);
$routes->get('/edit_my_user', 'Users::edit_my_user', ['filter' => 'role:user']);

$routes->get('/change-profile', 'Users::editEmail', ['filter' => 'role:user']);
$routes->post('/update-email/(:num)', 'Users::updateEmail/$1', ['filter' => 'role:user']);
$routes->get('/change-password', 'Users::changePassword', ['filter' => 'role:user']);
$routes->post('/update-password', 'Users::updatePassword', ['filter' => 'role:user']);
$routes->post('/sendEmail', 'Users::sendEmail');

// ==================================== CUSTOMER ===========================================
// ==================================== BOOKING ============================================
// ===================================== CREATE ============================================

$routes->get('/Form-Create-Booking', 'Booking::create', ['filter' => 'role:user']);
$routes->post('/Form-Save-Booking', 'Booking::save', ['filter' => 'role:user']);
$routes->get('/Form-Edit-Booking/(:any)', 'Booking::edit/$1', ['filter' => 'role:user']);
$routes->post('/Form-Update-Booking/(:any)', 'Booking::update/$1', ['filter' => 'role:user']);
$routes->delete('/History-List-Booking/(:num)', 'Booking::delete/$1', ['filter' => 'role:user']);

// ==================================== BOOKING ============================================
// ==================================== HISTORY ============================================

$routes->get('/History-List-Booking', 'Booking::index', ['filter' => 'role:user']);
$routes->post('/History-List-Booking', 'Booking::index', ['filter' => 'role:user']);

//  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>




// ==================================== CUSTOMER ===========================================
// ===================================== PRODUK ============================================
// ===================================== CREATE ============================================

$routes->get('/List-Produk', 'Produk::index', ['filter' => 'role:user']);
$routes->post('/List-Produk', 'Produk::index', ['filter' => 'role:user']);
$routes->get('/List-Produk/Detail/(:any)', 'Produk::detail/$1', ['filter' => 'role:user,admin']);
$routes->post('/List-Produk/Detail/keranjang/(:any)', 'Produk::save/$1', ['filter' => 'role:user']);

// ===================================== PRODUCT =============================================
// ===================================== HISTORY ============================================

$routes->get('/History-List-Produk', 'Produk::listHistory', ['filter' => 'role:user']);
$routes->post('/History-List-Produk', 'Produk::listHistory', ['filter' => 'role:user']);

//  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>




// ==================================== CUSTOMER ===========================================
// ===================================== MAKEUP ===========================================
// ===================================== CREATE ============================================

$routes->get('/List-Rent-Services', 'Makeup::create', ['filter' => 'role:user,admin']);
$routes->post('/List-Rent-Services/Cart/(:any)', 'Makeup::save', ['filter' => 'role:user']);
$routes->get('/List-Rent-Services/Customize-Service', 'Makeup::custom', ['filter' => 'role:user']);
$routes->post('/List-Rent-Services/Customize-Service', 'Makeup::custom', ['filter' => 'role:user']);
$routes->get('/List-History-Transaction', 'DetailTransaksi::historyMakeup', ['filter' => 'role:user']);
$routes->post('/List-History-Transaction', 'DetailTransaksi::historyMakeup', ['filter' => 'role:user']);
$routes->post('/List-History-Makeup/Status/(:any)', 'Transaksi::historyStatusMakeup', ['filter' => 'role:user']);
$routes->get('/Detail-Transaksi/(:any)', 'DetailTransaksi::orderMakeup/$1', ['filter' => 'role:user']);
$routes->post('/Detail-Transaksi/(:any)', 'DetailTransaksi::konfirmasiOrderMakeup/$1', ['filter' => 'role:user']);
$routes->post('/Detail-Terima-Transaksi/(:any)', 'Transaksi::terimaBarang/$1', ['filter' => 'role:user']);

//  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>




// ==================================== CUSTOMER ===========================================
// ===================================== PROSES ============================================
// ====================================== CART =============================================

$routes->get('/Cart', 'Cart::index', ['filter' => 'role:user']);
$routes->post('/Cart/(:any)', 'Cart::rincian/$1', ['filter' => 'role:user']);
$routes->delete('/Cart/(:num)', 'Cart::delete/$1', ['filter' => 'role:user']);
$routes->delete('/Cart/All', 'Cart::deleteAll', ['filter' => 'role:user']);
// $routes->get('/Cart/Konfirmasi', 'Cart::order', ['filter' => 'role:user']);
$routes->post('/Cart/Konfirmasi', 'Cart::order', ['filter' => 'role:user']);

// ==================================== CUSTOMER ===========================================
// ===================================== PROSES ============================================
// ==================================== SHIPMENT ===========================================

$routes->get('/Shipment/All', 'Cart::shipmentAll/$1', ['filter' => 'role:user']);
$routes->post('/Shipment/All', 'Order::shipmentPembayaranAll/$1', ['filter' => 'role:user']);
$routes->get('/Shipment/(:any)', 'Cart::shipment/$1', ['filter' => 'role:user']);
$routes->post('/Shipment/(:any)', 'Order::shipmentPembayaran/$1', ['filter' => 'role:user']);
// $routes->post('/Cart/Order', 'Order::index', ['filter' => 'role:user']);

// ==================================== CUSTOMER ===========================================
// ===================================== PROSES ============================================
// ===================================== PAYMENT ===========================================

$routes->get('/Konfirmasi', 'Order::detail', ['filter' => 'role:user']);
$routes->post('/Konfirmasi', 'Order::detail', ['filter' => 'role:user']);
$routes->get('/Konfirmasi/(:any)', 'Order::konfirmasi/$1', ['filter' => 'role:user']);
$routes->post('/Order/(:any)', 'Order::order/$1', ['filter' => 'role:user']);


// ============================== ADMIN ===============================================

$routes->get('/Admin-List-Transaksi', 'Transaksi::listAdmin', ['filter' => 'role:admin']);
$routes->post('/Admin-List-Transaksi', 'Transaksi::listAdmin', ['filter' => 'role:admin']);
$routes->get('/Detail-Admin-Transaksi/(:any)', 'Transaksi::detailAdmin/$1', ['filter' => 'role:admin']);
$routes->post('/Admin-Check-Transaksi/(:any)', 'Transaksi::check/$1', ['filter' => 'role:admin']);
$routes->post('/Admin-Resi-Transaksi/(:any)', 'Transaksi::resi/$1', ['filter' => 'role:admin']);
$routes->post('/Detail-Admin-Transaksi/returnFA/(:any)', 'Transaksi::returnedCheck/$1', ['filter' => 'role:admin']);
$routes->post('/Detail-Admin-Transaksi/rejectFA/(:any)', 'Transaksi::rejectedCheck/$1', ['filter' => 'role:admin']);
$routes->get('/Admin-History-List-Transaksi', 'Transaksi::listHistoryAdmin', ['filter' => 'role:admin']);
$routes->post('/Admin-History-List-Transaksi', 'Transaksi::listHistoryAdmin', ['filter' => 'role:admin']);
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
