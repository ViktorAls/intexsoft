<?php
	use app\models\Organization;
	use \app\models\worker;
    $keyOrg = array_keys($items['infOrganization'])[0];
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
                <th scope="row"><?=$items['infOrganization'][$keyOrg][Organization::displayName]?></th>
            </tr>
            <tr>
                <th scope="row">ОГРН: <?=$items['infOrganization'][$keyOrg][Organization::ogrn]?></th>
            </tr>
            <tr>
                <th scope="row">ОКТМО: <?=$items['infOrganization'][$keyOrg][Organization::oktmo]?></th>
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
            <?php foreach ($items['workers'] as $key => $value): ?>
                <tr>
                    <th scope="row"><?=$key?></th>
                    <td><?=$value[worker::middlename]?> <?=$value[worker::firstname]?> <?=$value[worker::lastname]?></td>
                    <td><?=$value[worker::birthday]?> </td>
                    <td><?=$value[worker::inn]?> </td>
                    <td><?=$value[worker::snils]?></td>
                    <td>
                        <div class="row">
                            <form method="post" action="/admin/organization/ref?worker=<?=$key?>&organization=<?=$keyOrg?>">
                                <input type="submit" value="Уволить" class="btn btn-primary btn-sm">
                            </form><pre> </pre>

                            <a href="/admin/worker/view?id=<?=$key?>" class="btn btn-primary btn-sm">Посмотреть</a> <pre> </pre>
                        
                        </div>
                    <td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>