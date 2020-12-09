<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Client extends DataLayer
{

    public function __construct()
    {
        parent::__construct("client", ["nome", "cpf", "idade"]);
    }

}