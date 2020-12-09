<?php


namespace Source\App;


use League\Plates\Engine;
use Source\Models\Client;

/**
 * Class Web
 * @package Source\App
 */
class Web
{
    /**
     * @var Engine
     */
    private $view;

    /**
     * Web constructor.
     */
    public function __construct()
    {
        $this->view = Engine::create(__DIR__."/../../theme", "php");
    }

    /**
     * Home
     */
    public function home()
    {
        echo $this->view->render("home", [
            "title" => "Home | Cadastro de cliente",
            "clients" => (new Client())->find()->order("nome")->fetch(true)
        ]);
    }


    /**
     * @param array $data
     */
    public function create(array $data): void
    {
        $clientData = filter_var_array($data, FILTER_SANITIZE_STRING);
        if (in_array("", $clientData)){
            $callback["message"] = message("Por favor informe: Nome, CPF e Idade!!!", "error");
            echo json_encode($callback);
            return;
        }
        $client = new Client();
        $client->nome = $clientData["nome"];
        $client->cpf = $clientData["cpf"];
        $client->idade = $clientData["idade"];
        $client->save();

        $callback["message"] = message("Client cadastrado com sucesso!", "success");
        $callback["clients"] = $this->view->render("client", ["client" => $client]);
        echo json_encode($callback);
    }

    /**
     * @param array $data
     */
    public function delete(array $data): void
    {
       if(empty($data["id"])){
           return;
       }

       $id = filter_var($data["id"], FILTER_VALIDATE_INT);
       $client = (new Client())->findById($id);
       if($client){
           $client->destroy();
       }

       $callback["remove"] = true;
       echo json_encode($callback);
    }

    public function fatura():void
    {
        echo "<h1>Fatura</h1>";
    }
}