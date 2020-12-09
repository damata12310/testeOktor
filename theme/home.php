<?php $v->layout("_theme");

?>
<div class="create">
    <div class="title mb-5">
        <h1 class="text-success">Cadastro de Cliente Oktor</h1>
    </div>

    <div class="form_ajax" style="display: none"></div>

    <form class="form" name="gallery" action="<?= url("create"); ?>" method="post"
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

        $("form").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var form_ajax = $(".form_ajax");
            var clients = $(".clients");

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

                    if (callback.clients) {
                        clients.prepend(callback.clients);
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
           var div = $(this).parent();

           $.post(data.action, data, function () {
              div.fadeOut();
           }, "json").fail(function (){
               alert("Erro falha na requisição!")
           });
        });
    });
</script>
<?php $v->end(); ?>
















