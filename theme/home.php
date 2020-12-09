<?php $v->layout("_theme");

?>

<div class="create">
    <div class="title mb-5">
        <h1 class="text-success">Cadastro de Cliente Oktor</h1>
    </div>

    <div class="form_ajax" style="display: none"></div>
    <form class="form" name="gallery" action="" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome">
                <input type="text" id="nome" name="nome" placeholder="Nome:"/>
            </label>
        </div>
        <div class="form-group">
            <label for="cpf">
                <input type="text" id="cpf" name="cpf" placeholder="CPF:"/>
            </label>
        </div>
        <div class="form-group">
            <label for="idade">
                <input type="text" id="idade" name="idade" placeholder="idade:"/>
            </label>
        </div>
        <button type="submit" class="btn btn-outline-success">Salvar</button>
    </form>
</div>

<section class="users">
    <?php
        if (!empty($clients)):
            foreach($clients as $client):
              $v->insert("client", ["client" => $client]);
            endforeach;
        endif;
    ?>
</section>