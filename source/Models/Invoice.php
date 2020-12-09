<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Invoice extends DataLayer
{
    public function __construct()
    {
        parent::__construct("invoice", ["valor", "vencimento", "id_client"]);
    }
}