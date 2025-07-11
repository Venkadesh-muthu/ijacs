<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\AdminController;
use App\Controllers\MainController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->get('about', 'MainController::about');
$routes->get('archives', 'MainController::archives');
$routes->get('aimscope', 'MainController::aimScope');
$routes->get('editorial-board', 'MainController::editorialBoard');
$routes->get('special-issues', 'MainController::specialIssues');
$routes->get('contact', 'MainController::contact');
$routes->get('current-issue', 'MainController::currentIssue');
$routes->get('article/(:num)', 'MainController::detail/$1');
$routes->get('issues', 'MainController::issues');
$routes->get('special-issues', 'MainController::specialIssues');
$routes->get('issue/(:num)', 'MainController::issueDetail/$1');



$routes->group('admin', function ($routes) {

    // Public routes (no auth required)
    $routes->get('/', 'AdminController::index');             // Login form
    $routes->post('login', 'AdminController::login');        // Login submit
    $routes->get('logout', 'AdminController::logout');       // Logout

    // Profile
    $routes->post('profile/update', 'AdminController::updateProfile');

    // Protected routes (apply filter in controller or group)
    $routes->get('dashboard', 'AdminController::dashboard');

    // Volume Management
    $routes->get('volumes', 'AdminController::volumes');
    $routes->match(['get', 'post'], 'volumes/add', 'AdminController::addVolume');
    $routes->match(['get', 'post'], 'volumes/edit/(:num)', 'AdminController::editVolume/$1');
    $routes->get('volumes/delete/(:num)', 'AdminController::deleteVolume/$1');

    // Issue Management
    $routes->get('issues', 'AdminController::issues');
    $routes->match(['get', 'post'], 'issues/add', 'AdminController::addIssue');
    $routes->match(['get', 'post'], 'issues/edit/(:num)', 'AdminController::editIssue/$1');
    $routes->get('issues/delete/(:num)', 'AdminController::deleteIssue/$1');

    // Article Management
    $routes->get('articles', 'AdminController::articles');
    $routes->match(['get', 'post'], 'articles/add', 'AdminController::addArticle');
    $routes->match(['get', 'post'], 'articles/edit/(:num)', 'AdminController::editArticle/$1');
    $routes->get('articles/delete/(:num)', 'AdminController::deleteArticle/$1');

    $routes->get('references', 'AdminController::listReferences');          // List
    $routes->match(['get', 'post'], 'references/add', 'AdminController::addReference');
    $routes->match(['get', 'post'], 'references/edit/(:num)', 'AdminController::editReference/$1'); // Edit
    $routes->get('references/delete/(:num)', 'AdminController::deleteReference/$1');   // Delete

    $routes->get('upload-article-xml', 'AdminController::uploadArticleXmlForm');
    $routes->post('upload-article-xml', 'AdminController::uploadArticleXml');



});
