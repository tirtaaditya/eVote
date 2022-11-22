<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Main');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Dashboard
$routes->add('dashboard/banknotes','Dashboard\Banknotes::index');
$routes->add('dashboard/banknotes/detail','Dashboard\Banknotes::detail');

// Kurs
$routes->add('kurs/nilai', 'Kurs\Inquiry::index');
$routes->add('kurs/range', 'Kurs\Range::index');

// Manejemen
$routes->add('manajemen/registrasiia', 'Manajemen\Registrasiia::index');
$routes->add('manajemen/registrasiia/(:num)', 'Manajemen\Registrasiia::show/$1');
$routes->add('manajemen/registrasiia/create', 'Manajemen\Registrasiia::create');

$routes->add('manajemen/role', 'Manajemen\Role::index');

// Geser Terima
$routes->add('kas/geserterima', 'Kas\GeserTerima::index');
$routes->add('kas/geserterima/detail/(:num)', 'Kas\GeserTerima::show/$1');
$routes->add('kas/geserterima/terima/(:num)', 'Kas\GeserTerima::show/$1');

// Purpose
$routes->add('manajemen/purpose', 'Manajemen\Purpose::index');
$routes->add('manajemen/purpose/(:num)', 'Manajemen\Purpose::show/$1');
$routes->add('manajemen/purpose/create', 'Manajemen\Purpose::create');

// Underlying
$routes->add('manajemen/underlying', 'Manajemen\Underlying::index');
$routes->add('manajemen/underlying/(:num)', 'Manajemen\Underlying::show/$1');
$routes->add('manajemen/underlying/create', 'Manajemen\Underlying::create');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
