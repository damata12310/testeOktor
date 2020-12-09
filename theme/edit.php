
<form id="teste" class="formEdit" name="gallery" action="<?= url("update"); ?>" method="post"
      enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $edit->id; ?>"/>
    <div class="form-group">
        <label for="nome">
            <input type="text" id="nome" name="nome" value="<?= $edit->nome; ?>" placeholder="Nome:"/>
        </label>
    </div>
    <div class="form-group">
        <label for="cpf">
            <input type="text" id="cpf" name="cpf" value="<?= $edit->cpf; ?>" placeholder="CPF:"/>
        </label>
    </div>
    <div class="form-group">
        <label for="idade">
            <input type="text" id="idade" name="idade" value="<?= $edit->idade; ?>" placeholder="idade:"/>
        </label>
    </div>
    <button type="submit" class="btn btn-outline-success">Salvar</button>
</form>






