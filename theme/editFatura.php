
<form id="teste" class="formEdit" name="gallery" action="<?= url("fatura/update"); ?>" method="post"
      enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $edit->id; ?>"/>
    <div class="form-group">
        <label for="valor">
            <input type="text" id="valor" name="valor" value="<?= $edit->valor; ?>" placeholder="Valor:"/>
        </label>
    </div>
    <div class="form-group">
        <label for="vencimento">
            <input type="date" id="vencimento" name="vencimento" value="<?= $edit->vencimento; ?>" placeholder="Vencimento:"/>
        </label>
    </div>
    <button type="submit" class="btn btn-outline-success">Salvar</button>
</form>






