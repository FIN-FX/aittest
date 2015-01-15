<?php
ini_set('display_errors', 1);

require 'vendor/autoload.php';
try
{
  $router = new Common\Router();
  Common\Router::setAppPath(dirname(__FILE__));

  $router->registerRouteGet('user/address');

  $dispatcher = new Common\Dispatcher($router);
  $dispatcher->handle();
}
catch (Common\HttpException $e)
{
  $e->render();
}

