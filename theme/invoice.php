<article class="faturas_fatura">
    <div class="col-md-6">
        <?php
        if(!empty($client)): ?>
            <h3 class="text-info"><?= "$client->nome"; ?></h3>
        <?php endif;

        if (!empty($clients)):
            foreach ($clients as $client):
                if ($client->id == $fatura->id_client):
                    ?>
                    <h3 class="text-info"><?= "$client->nome"; ?></h3>
                <?php
                endif;
            endforeach;
        endif;
        ?>
    <h3 class="text-warning">Valor: <?= "$fatura->valor "?></h3>
    <h3 class="text-warning">Vencimento: <?= date("d-m-Y", strtotime($fatura->vencimento)) ?></h3>
    </div>
    <div class="col-md-6">
        <a class="btn btn-outline-danger remove" href="#"
           data-action="<?= url("fatura/delete"); ?>"
           data-id="<?= $fatura->id; ?>" data-type="remove">
            Deletar
        </a>
        <a class="btn btn-outline-warning edit" href="#"
           data-action="<?= url("fatura/update-home"); ?>"
           data-id="<?= $fatura->id; ?>" data-type="edit">
            Editar
        </a>
    </div>
</article>