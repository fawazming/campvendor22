<?php namespace Config;

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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/special', 'Home::special');
$routes->get('/manual', 'Home::manual');
$routes->get('/sync/(:any)', 'Home::sync/$1');
$routes->get('/lock/(:any)', 'Home::lock/$1');
$routes->get('/tag', 'Home::tag');
$routes->get('/sellpin', 'Home::sellpin');
$routes->get('/calibrate', 'Home::calibrate');
$routes->get('/reset', 'Home::resetPin');
$routes->post('/auth', 'Home::auth');
$routes->post('/sharepin', 'Home::sharepin');
$routes->post('/printtag', 'Home::printtag');
$routes->post('/printotag', 'Home::printotag');
$routes->post('/printpins', 'Home::printpins');
$routes->post('/printvtag', 'Home::printvtag');
$routes->post('/logupdate', 'Home::logupdate');
$routes->get('/admin/logout', 'Home::logout');

/**
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
