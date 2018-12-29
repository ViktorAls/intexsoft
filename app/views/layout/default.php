<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/box.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title?></title>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/">Главная страница</a></h5>
    <nav class="my-2 my-md-0 mr-md-3">
	    <? if($_SESSION['role'] == 'admin'):?>
            <a class="p-2 text-dark" href="/admin/organization">Оргинизации</a>
            <a class="p-2 text-dark" href="/admin/worker">Работники</a>

            <a class="p-2 text-dark" href="/main/logout">Выход(<?=$_SESSION['role']?>)</a>
	    <?elseif ($_SESSION['role'] == 'user'):?>
            <a class="p-2 text-dark" href="/worker/information">Информация о себе</a>
            <a class="p-2 text-dark" href="/main/logout">Выход(<?=$_SESSION['role']?>)</a>
	    <?else:?>
            <a class="p-2 text-dark" href="/main/login">Вход</a>
	    <?endif;?>
    </nav>
</div>
<div class="container">
 <?if (!empty($_SESSION['error'])):?>
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>Ошибка: </strong><?=$_SESSION['error']?>
         <? unset($_SESSION['error']); ?>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
     </div>
    <?elseif (!empty($_SESSION['success'])):?>
     <div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Успех:</strong> <?=$_SESSION['success'];?>
	     <? unset($_SESSION['success']); ?>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
     </div>
    <?endif;?>
    <?=$content?>
    
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>