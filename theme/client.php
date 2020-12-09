<article class="clients_client">
    <div class="col-md-6">
        <h3 class="text-info"><?= "$client->nome"; ?></h3>
    </div>
    <div class="col-md-6">
        <a class="btn btn-outline-danger remove" href="#"
           data-action="<?= url("delete"); ?>"
           data-id="<?= $client->id; ?>" data-type="remove">
            Deletar
        </a>
        <a class="btn btn-outline-warning edit" href="<?= url("update-home"); ?>"
           data-action="<?= url("update-home"); ?>"
           data-id="<?= $client->id; ?>" data-type="edit">

            Editar
        </a>
    </div>
</article>