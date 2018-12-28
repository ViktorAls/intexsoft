<?
	use app\models\Organization;
	use \app\models\worker;
    $key = array_keys($items['infOrganization'])[0];
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
                <th scope="row"><?=$items['infOrganization'][$key][Organization::displayName]?></th>
            </tr>
            <tr>
                <th scope="row">ОГРН: <?=$items['infOrganization'][$key][Organization::ogrn]?></th>
            </tr>
            <tr>
                <th scope="row">ОКТМО: <?=$items['infOrganization'][$key][Organization::oktmo]?></th>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-9">
        <table class="table">
            <thead class="thead-default">
            <tr>
                <th>#</th>
                <th>Работник</th>
                <th>Дата рождения</th>
                <th>inn</th>
                <th>snils</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($items['workers'] as $key => $value): ?>
                <tr>
                    <th scope="row"><?=$key?></th>
                    <td><?=$value[worker::middlename]?> <?=$value[worker::firstname]?> <?=$value[worker::lastname]?></td>
                    <td><?=$value[worker::birthday]?> </td>
                    <td><?=$value[worker::inn]?> </td>
                    <td><?=$value[worker::snils]?></td>
                    <td><a href="/admin/worker/view?id=<?=$key?>">Просмотреть</a>/<a href="/admin/worker/delete?id=<?=$key?>">Уволить</a></td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>