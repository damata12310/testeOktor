<?php
use CoffeeCode\Router\Router;
require __DIR__ . "/vendor/autoload.php";

$route = new Router(ROOT);

/**
 * APP
 */
$route->namespace("Source\App");

/**
 * web
 */
$route->group(null);
$route->get("/", "Web:home");
$route->get("/cliente", "Web:home");
$route->post("/create", "Web:create");
$route->post("/delete", "Web:delete");

$route->get("/fatura", "Web:fatura");

/**
 * ERROR
 */
$route->group("ops");
$route->get("/{errcode}", "Web:error");

/**
 * PROCESS
 */
$route->dispatch();

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}