<?$title = ' '.$items['code'].' '.$items['title']?>
<div class="alert alert-primary" role="alert">
	<h4 class="alert-heading">Произошла ошибка ( <?=$items['code'].' '.$items['title']?> )</h4>
	<p><?=$items['message'];?></p>
	<hr>
	<p class="mb-0">Если Вы считаете, что это ошибка сервера, то обратитесь к администратору.</p>
</div>
