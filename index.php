<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', '1');
*/

$pkg = file_get_contents('package.json');
$pkg_json = json_decode($pkg, true);
$version = $pkg_json['version'];

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].DIRECTORY_SEPARATOR);

require 'vendor/autoload.php';

$app = new \Slim\App();

$container = $app->getContainer();

$container['view'] = function($container){
    return new \Slim\Views\PhpRenderer('templates/');
};

$container['version'] = $version;

$app->get('/', function (Request $request, Response $response, $args) {

    return $this->view->render($response->withAddedHeader('Cache-Control', 'no-cache, must-revalidate')
        ->withAddedHeader('Expires', gmdate("D, d M Y H:i:s", strtotime("-1 day")) . " GMT"), 'index.php', [
        'app'=>'c1App',
        'hide_top_nav'=>false,
        'version'=>str_replace('.', '_', $this->version)
    ]);
});

$app->get('/login', function (Request $request, Response $response, $args) use ($app) {
    return $this->view->render($response, 'login.php', [
        'app'=>'c1App',
        'controller'=>'LoginController',
        'hide_top_nav'=>true,
        'version'=>str_replace('.', '_', $this->version)
    ]);
});

$app->get('/logout', function (Request $request, Response $response, $args) {
    return $this->view->render($response, 'login.php', [
        'app'=>'c1App',
        'controller'=>'LoginController',
        'hide_top_nav'=>true,
        'version'=>str_replace('.', '_', $this->version)
    ]);
});
/*
$app->get('/admin/leads', function (Request $request, Response $response, $args) {
    return $this->view->render($response, 'admin/leads.php', [
        'app'=>'c1App',
        'controller'=>'AdminLeadsController',
        'active_page_slug'=>'admin'
    ]);
});

$app->get('/admin/users', function (Request $request, Response $response, $args) {
    return $this->view->render($response, 'admin/users.php', [
        'app'=>'c1App',
        'controller'=>'AdminUsersController',
        'active_page_slug'=>'admin'
    ]);
});

$app->get('/admin/teams', function (Request $request, Response $response, $args) {
    return $this->view->render($response, 'admin/teams.php', [
        'app'=>'c1App',
        'controller'=>'AdminTeamsController',
        'active_page_slug'=>'admin'
    ]);
});

$app->get('/search', function (Request $request, Response $response, $args) {
    return $this->view->render($response, 'search.php', [
        'app'=>'c1App',
        'controller'=>'SearchController',
        'active_page_slug'=>'search'
    ]);
});

$app->get('/leads', function (Request $request, Response $response, $args) {
    return $this->view->render($response, 'leads.php', [
        'app'=>'c1App',
        'controller'=>'LeadsController',
        'active_page_slug'=>'leads'
    ]);
});

$app->get('/pipeline', function (Request $request, Response $response, $args) {
    return $this->view->render($response, 'pipeline.php', [
        'app'=>'c1App',
        'controller'=>'PipelineController',
        'active_page_slug'=>'pipeline'
    ]);
});
*/
$app->get('/print/app/{id}', function (Request $request, Response $response, $args) {
    $id = $request->getAttribute('id');

    $url = 'http://localhost/api/apps/print/' . $id;


        $ch = curl_init();

        //curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $data = curl_exec($ch);

    return $this->view->render($response, 'print_app.php', [
        'data'=>$data
    ]);

});

$app->run();