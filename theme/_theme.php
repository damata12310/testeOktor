<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oktor <?= $title; ?></title>

    <link rel="stylesheet" href="<?= url("/theme/assets/css/style.css"); ?>"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <div class="ajax_load_box_title">Aguarde, carregando!</div>
    </div>
</div>

<main class="content">
    <nav class="navbar navbar-light bg-light rounded mb-5">
        <a class="navbar-brand" href="#">
            <img src="<?= url("")."/theme/assets/img/logo-oktor-175x52-new.png" ?>"  class="d-inline-block align-top" alt="">
        </a>
        <div class="menu">
            <a href="<?= url("/"); ?>" class="nav-link border rounded mr-2">Clientes</a>
            <a href="<?= url("fatura"); ?>" class="nav-link border rounded ml-2">Faturas</a>
        </div>
    </nav>
    <?= $v->section("content"); ?>
</main>

<script src="<?= url("/theme/assets/js/jquery-3.5.1.min.js"); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?= $v->section("js"); ?>
</body>
</html>







