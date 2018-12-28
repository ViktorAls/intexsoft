<form action="/main/login" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputLogin">Login</label>
                <input type="text" class="form-control" name="name" id="inputLogin" placeholder="login">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Авторизоваться</button>
    </form>
    <br>
	<?if(isset($items['error'])):?>
        <b>Ошибка: </b><?=$items['error'];?>
	<?endif;?>

