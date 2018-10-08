<?php
include __DIR__ . '/../vendor/autoload.php';

$conf = require_once __DIR__ . '/../config/container.config.php';

$app = new \Slim\App($conf);

$container = $app->getContainer();
$container->register(new \Libs\Services\EloquentServiceProvider());
$container->register(new \OsLab\Slim\MonologProvider());

$app->get('/', function (\Slim\Http\Request $request, \Slim\Http\Response $response, array $args) {
    $articles = \Bin\Models\Home::all();
    return $response->withJson($articles);
});

$app->get('/auth', function (\Slim\Http\Request $request, \Slim\Http\Response $response, array $args) {
    $response->getBody()->write('This is Authorisation page');
});

$app->get('/db', function (\Slim\Http\Request $request, \Slim\Http\Response $response, array $args) use($container){

});




