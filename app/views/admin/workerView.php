<?
	use app\models\Organization;
	use \app\models\worker;
	$key = array_keys($items['user'])[0];
?>

<div class="row">
	<div class="col-md-3">
		<table class="table table-reflow">
			<thead>
			<tr>
				<th>Информация о предприятии</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<th scope="row"><?=$items['user'][worker::middlename]?> <?=$items['user'][worker::firstname]?> <?=$items['user'][worker::lastname]?></th>
			</tr>
			<tr>
				<th scope="row">СНИЛС: <?=$items['user'][worker::snils]?></th>
			</tr>
			<tr>
				<th scope="row">ИНН: <?=$items['user'][worker::inn]?></th>
			</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-9">
		<table class="table">
			<thead class="thead-default">
			<tr>
				<th>#</th>
				<th>Организация</th>
				<th>ОКТМО</th>
				<th>ОГРН</th>
				<th>Ставка</th>
			</tr>
			</thead>
			<tbody>
			<? foreach ($items['organizations'] as $key => $value): ?>
				<tr>
					<th scope="row"><?=$key?></th>
					<td><?=$value[Organization::displayName]?></td>
					<td><?=$value[Organization::oktmo]?> </td>
					<td><?=$value[Organization::ogrn]?> </td>
					<td><?=$value['rate']?></td>
				</tr>
			<?endforeach;?>
			</tbody>
		</table>
	</div>
</div>