<?php


namespace Source\App;


use League\Plates\Engine;
use Source\Models\Client;

class Web
{
    private $view;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__."/../../theme", "php");
    }

    public function home()
    {
        echo $this->view->render("home", [
            "title" => "Home | Cadastro de cliente",
            "clients" => (new Client())->find()->order("nome")->fetch(true)
        ]);
    }
}