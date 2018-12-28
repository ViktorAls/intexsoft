<table class="table">
	<thead>
	<tr>
		<th>#</th>
		<th>Название организации</th>
		<th>ОГРН</th>
		<th>ОКТМО</th>
		<th>Действие</th>
	</tr>
	</thead>
	<tbody>
    <?foreach ($items['organization'] as $key => $value):?>
	<tr>
		<th scope="row"><?=$key?></th>
		<td><?=$value['displayName']?></td>
		<td><?=$value['ogrn']?></td>
		<td><?=$value['oktmo']?></td>
		<td><a href="/admin/organization/delete?id=<?=$key?>">Удалить</a>/<a href="/admin/organization/view?id=<?=$key?>">Посмотреть</a></td>
	</tr>
    <?endforeach;?>
	</tbody>
</table>