<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">XML обработка</h4>
            </div>
            <div class="modal-body">
                <form action="/admin/xml" ENCTYPE="multipart/form-data" method="post">
                    <input type="file" name = "file" class="btn btn-primary btn-sm">
                    <input type="submit" class="btn btn-primary btn-sm">
                </form>
           
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-11"></div>
    <div class="col-md-1">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
            XML обработка
        </button>
    </div>
</div>

<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Название организации</th>
        <th>ОГРН</th>
        <th>ОКТМО</th>
        <th><div class="row">
                <div class="col-md-1">
                    <a href="/admin/organization/create" class="btn btn-primary btn-sm" >Добавить новую организацию</a>
                </div>
            </div>
        </th>
    </tr>
    </thead>
    <tbody>
    <?foreach ($items['organization'] as $key => $value):?>
        <tr>
            <th scope="row"><?=$key?></th>
            <td><?=$value['displayName']?></td>
            <td><?=$value['ogrn']?></td>
            <td><?=$value['oktmo']?></td>
            <td>
                <div class="row">
                <form method="post" action="/admin/organization/delete?id=<?=$key?>">
                    <input type="submit" value="Удалить" class="btn btn-primary btn-sm">
                 </form><pre> </pre>
                 
                <a href="/admin/organization/view?id=<?=$key?>" class="btn btn-primary btn-sm">Посмотреть</a> <pre> </pre>
                
                <a href="/admin/organization/update?id=<?=$key?>" class="btn btn-primary btn-sm">Изменить</a><pre> </pre>
                </div>
            </td>
        </tr>
    <?endforeach;?>
    </tbody>
</table>