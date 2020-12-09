<?php $v->layout("_theme");

?>
<div class="create">
    <div class="title mb-5">
        <h1 class="text-success">Cadastro de Faturas Oktor</h1>
    </div>

    <div class="form_ajax" style="display: none"></div>

    <section class="formEdit" style="display: flex">
        <?php
            if (!empty($formEdit)){
                $v->insert("editFatura", ["edit" => $formEdit]);
            }
        ?>
    </section>

    <form class="form" name="gallery" action="<?= url("fatura/create"); ?>" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label for="valor">
                <input type="text" id="valor" name="valor" placeholder="Valor:"/>
            </label>
        </div>

        <div class="form-group">
            <label for="vencimento">
                <input type="date" id="vencimento" name="vencimento" placeholder="Vencimento:"/>
            </label>
        </div>

        <div class="form-group">
            <label for="client">
                <select class="form-control" id="client" name="id_client">
                    <option>Escolha o cliente</option>
                    <?php
                    if (!empty($clients)):
                        foreach ($clients as $client):
                            ?>
                            <option value="<?= $client->id ?>"><?= $client->nome ?></option>
                        <?php
                        endforeach;
                    endif;
                    ?>

                </select>
            </label>
        </div>
        <button type="submit" class="btn btn-outline-success">Salvar</button>
    </form>
</div>

<section class="faturas">
    <?php
    if (!empty($faturas)):
        foreach($faturas as $fatura ):
                $v->insert("invoice", ["fatura" => $fatura]);
        endforeach;
    endif;
    ?>
</section>

<?php $v->start("js"); ?>
<script>
    $(function (){
        function load(action) {
            var load_div = $(".ajax_load");
            if (action === "open"){
                load_div.fadeIn().css("display", "flex");
            }else{
                load_div.fadeOut();
            }
        }

        $("form").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var form_ajax = $(".form_ajax");
            var faturas = $(".faturas");

            $.ajax({
                url: form.attr("action"),
                data: form.serialize(),
                type: "POST",
                dataType: "json",
                beforeSend: function () {
                    load("open");
                },
                success: function (callback) {
                    if (callback.message){
                        form_ajax.html(callback.message).fadeIn();
                    }else {
                        form_ajax.fadeOut(function () {
                            $(this).html("");
                        });
                    }

                    if (callback.faturas) {
                        faturas.prepend(callback.faturas);
                        $('form input').val(""); //coloca todos valores de todos inputs do form como vazio
                        $('form select').val("Escolha o cliente"); //Volta o select de clientes para o default
                        $('form input[type = submit]').val("Salvar"); //recoloca o texto no botão
                    }
                },
                complete: function () {
                    load("close");
                }
            });
        });

        $(".formEdit").submit(function (e) {
            e.preventDefault();
            var form = $("#teste");
            var form_ajax = $(".form_ajax");
            var faturas = $(".faturas");
            var dados = $("#teste").serialize();
            var url = $("#teste").attr("action");


            $.ajax({
                url: url,
                data: dados,
                type: "POST",
                dataType: "json",
                beforeSend: function () {
                    load("open");
                },
                success: function (callback) {
                    if (callback.message){
                        form_ajax.html(callback.message).fadeIn();
                    }else {
                        form_ajax.fadeOut(function () {
                            $(this).html("");
                        });
                    }

                    if (callback.faturas) {
                        faturas.prepend(callback.faturas);
                        $('form input').val(""); //coloca todos valores de todos inputs do form como vazio
                        $('form select').val("Escolha o cliente"); //Volta o select de clientes para o default
                        $('form input[type = submit]').val("Salvar"); //recoloca o texto no botão
                    }
                },
                complete: function () {
                    load("close");
                }
            });
        });




        $("body").on("click", "[data-action]", function (e) {
            e.preventDefault();
            var data = $(this).data();
            var div = $(this).parent().parent();

            var form = $(this);
            var form_ajax = $(".form_ajax");
            var faturas = $(".faturas");
            var formEdit = $(".formEdit");

            if (data.type === "remove"){
                console.log(data.action);
                $.post(data.action, data, function () {
                    div.fadeOut();
                }, "json").fail(function (){
                    alert("Erro falha na requisição!")
                });
            }else{
                $.ajax({
                    url: data.action,
                        data: data,
                        type: "POST",
                        dataType: "json",
                        beforeSend: function () {
                        load("open");
                    },
                    success: function (callback) {
                        if (callback.message){
                            form_ajax.html(callback.message).fadeIn();
                        }else {
                            form_ajax.fadeOut(function () {
                                $(this).html("");
                            });
                        }
                        div.fadeOut();
                        if (callback.formEdit) {
                            formEdit.prepend(callback.formEdit);
                            $('.form').hide();
                        }
                    },
                    complete: function () {
                        load("close");
                    }
                });
            }

        });
    });
</script>
<?php $v->end(); ?>

























