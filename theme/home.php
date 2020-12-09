<?php $v->layout("_theme");

?>
<div class="create">
    <div class="title mb-5">
        <h1 class="text-success">Cadastro de Cliente Oktor</h1>
    </div>

    <div class="form_ajax" style="display: none"></div>

<section class="formEdit" style="display: flex">
    <?php

    if (!empty($formEdit)) {
        $v->insert("edit", ["edit" => $formEdit]);
    }

    ?>
</section>
    <form class="formCreate" name="gallery" action="<?= url("create"); ?>" method="post"
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

<section class="clients">
    <?php
        if (!empty($clients)):
            foreach($clients as $client):
              $v->insert("client", ["client" => $client]);
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

        $(".formCreate").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var form_ajax = $(".form_ajax");
            var clients = $(".clients");
console.log(form.attr("action"));
            // $.ajax({
            //    url: form.attr("action"),
            //    data: form.serialize(),
            //    type: "POST",
            //    dataType: "json",
            //    beforeSend: function () {
            //         load("open");
            //    },
            //     success: function (callback) {
            //         if (callback.message){
            //             form_ajax.html(callback.message).fadeIn();
            //         }else {
            //             form_ajax.fadeOut(function () {
            //                $(this).html("");
            //             });
            //         }
            //
            //         if (callback.clients) {
            //             clients.prepend(callback.clients);
            //             $('form input').val(""); //coloca todos valores de todos inputs do form como vazio
            //             $('form input[type = submit]').val("Salvar"); //recoloca o texto no botão
            //         }
            //     },
            //     complete: function () {
            //         load("close");
            //     }
            // });
        });

$(".formEdit").submit(function (e) {
    e.preventDefault();
    var form = $("#teste");
    var form_ajax = $(".form_ajax");
    var clients = $(".clients");
    var dados = $("#teste").serialize();
    var url = $("#teste").attr("action");
console.log(dados);
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

            if (callback.clients) {
                clients.prepend(callback.clients);
                $('form input').val(""); //coloca todos valores de todos inputs do form como vazio
                $('form input[type = submit]').val("Salvar"); //recoloca o texto no botão
            }
        },
        complete: function () {
            load("close");
        }
    });
})



        $("body").on("click", "[data-action]", function (e) {
           e.preventDefault();
           var data = $(this).data();
           var div = $(this).parent().parent();
           var formEdit = $(".formEdit");
           var form_ajax = $(".form_ajax");


            if (data.type === "remove"){
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
                            $('.formCreate').hide();

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
















