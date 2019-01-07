<?php
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
	<?php foreach ($items['user'] as $key => $value): ?>
		<tr>
			<th scope="row"><?=$key?></th>
			<td><?=$value[worker::middlename]?> <?=$value[worker::firstname]?> <?=$value[worker::lastname]?></td>
			<td><?=$value[worker::birthday]?> </td>
			<td><?=$value[worker::inn]?> </td>
			<td><?=$value[worker::snils]?></td>
            <td>
                <div class="row">
                    <form method="post" action="/admin/worker/delete?id=<?=$key?>">
                        <input type="submit" value="Удалить" class="btn btn-primary btn-sm">
                    </form><pre> </pre>

                    <a href="/admin/worker/view?id=<?=$key?>" class="btn btn-primary btn-sm">Посмотреть</a> <pre> </pre>

                    <a href="/admin/worker/update?id=<?=$key?>" class="btn btn-primary btn-sm">Изменить</a><pre> </pre>
                </div>
            </td>		</tr>
	<?php endforeach;?>
	</tbody>
</table>
	