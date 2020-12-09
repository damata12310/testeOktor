<article class="clients_client">
    <h3 class="text-info"><?= "$client->nome"; ?></h3>
    <a class="btn btn-outline-danger remove" href="#"
       data-action="<?= url("delete"); ?>"
       data-id="<?= $client->id; ?>" >
        Deletar
    </a>
</article>