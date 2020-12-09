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
$route->post("/update-home", "Web:updateHome");
$route->post("/update", "Web:clientUpdate");
$route->post("/delete", "Web:delete");

$route->get("/fatura", "Web:fatura");
$route->post("/fatura/create", "Web:faturaCreate");
$route->post("/fatura/delete", "Web:faturaDelete");
$route->post("/fatura/update-home", "Web:updateHomeFatura");
$route->post("/fatura/update", "Web:faturaUpdate");

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