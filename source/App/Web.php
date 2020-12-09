<?php


namespace Source\App;


use League\Plates\Engine;
use Source\Models\Client;
use Source\Models\Invoice;
use function League\Plates\Util\id;

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
    public function home(): void
    {
        echo $this->view->render("home", [
            "title" => "Home | Cadastro de cliente",
            "formEdit" => null,
            "clients" => (new Client())->find()->order("nome")->fetch(true)
        ]);
    }

    public function updateHome(array $data): void
    {
        if ($data){

            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            $client = (new Client())->findById($id);

            $callback["message"] = message("Edite o cliente", "success");
            $callback["formEdit"] =  $this->view->render("edit", ["edit" => $client]);
            echo json_encode($callback);
        }
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

    public function clientUpdate(array $data): void
    {
        $clientData = filter_var_array($data, FILTER_SANITIZE_STRING);
        $client = (new Client())->findById($clientData["id"]);
        $client->nome = $clientData["nome"];
        $client->cpf = $clientData["cpf"];
        $client->idade = $clientData["idade"];
        $client->save();

        $callback["message"] = message("Client editado com sucesso!", "success");
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


    /* Fatura */


    public function fatura():void
    {
        echo $this->view->render("fatura", [
            "title" => "Home | Cadastro de fatura",
            "clients" => (new Client())->find()->order("nome")->fetch(true),
            "faturas" => (new Invoice())->find()->order("vencimento")->fetch(true)
        ]);
    }

    public function faturaCreate(array $data): void
    {
        $faturaData = filter_var_array($data, FILTER_SANITIZE_STRING);
        if (in_array("", $faturaData)){
            $callback["message"] = message("Por favor informe: valor, vencimento e o cliente!!!", "error");
            echo json_encode($callback);
            return;
        }
        $fatura = new Invoice();
        $fatura->valor = $faturaData["valor"];
        $fatura->vencimento = $faturaData["vencimento"];
        $fatura->id_client = $faturaData["id_client"];
        $fatura->save();

        $client = (new Client())->findById($faturaData["id_client"]);

        $callback["message"] = message("Fatura cadastrada com sucesso!", "success");
        $callback["faturas"] = $this->view->render("invoice", ["fatura" => $fatura, "client" => $client]);
        echo json_encode($callback);

    }

    public function faturaDelete(array $data): void
    {
        if (empty($data["id"])){
            return;
        }

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $fatura = (new Invoice())->findById($id);
        if ($fatura){
            $fatura->destroy();
        }

        $callback["remove"] = true;
        echo json_encode($callback);

    }

    public function updateHomeFatura(array $data): void
    {
        if ($data){

            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            $invoice = (new Invoice())->findById($id);

            $callback["message"] = message("Edite a fatura", "success");
            $callback["formEdit"] =  $this->view->render("editFatura", ["edit" => $invoice]);
            echo json_encode($callback);
        }
    }

    public function faturaUpdate(array $data): void
    {

        $invoiceData = filter_var_array($data, FILTER_SANITIZE_STRING);
        $invoice = (new Invoice())->findById($invoiceData["id"]);

        $invoice->valor = $invoiceData["valor"];
        $invoice->vencimento = $invoiceData["vencimento"];
        $invoice->save();

        $client = (new Client())->findById($invoiceData["id"]);

        $callback["message"] = message("Client editado com sucesso!", "success");
        $callback["faturas"] = $this->view->render("invoice", ["fatura" => $invoice, "client" => $client]);
        echo json_encode($callback);
    }
}