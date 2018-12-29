<?
use app\models\worker;
?>

<table class="table">
	<thead class="thead-default">
	<tr>
		<th>#</th>
		<th>Работник</th>
		<th>Дата рождения</th>
		<th>inn</th>
		<th>snils</th>
        <th>
            <a href="/admin/worker/create" class="btn btn-primary btn-sm" >Добавить нового рабочего</a>

        </th>
    </tr>
	</thead>
	<tbody>
	<? foreach ($items['user'] as $key => $value): ?>
		<tr>
			<th scope="row"><?=$key?></th>
			<td><?=$value[worker::middlename]?> <?=$value[worker::firstname]?> <?=$value[worker::lastname]?></td>
			<td><?=$value[worker::birthday]?> </td>
			<td><?=$value[worker::inn]?> </td>
			<td><?=$value[worker::snils]?></td>
			<td><a href="/admin/worker/view?id=<?=$key?>">Просмотреть</a>/<a href="/admin/worker/delete?id=<?=$key?>">Удалить</a>/<a href="/admin/worker/update?id=<?=$key?>">Изменить</a></td>
		</tr>
	<?endforeach;?>
	</tbody>
</table>
	