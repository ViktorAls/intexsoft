<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Добавить новую организацию</h3>
            </div>
            <div class="box-body">
                <div>
                    <form action="/admin/organization/create" method="post">
                        <input type="text" name='organization[<?= \app\models\Organization::displayName ?>]'
                               value="<?=\app\lib\Request::post('organization')['displayName'];?>"
                               class="form-control" placeholder="Название предприятия" aria-describedby="basic-addon2">
                        <br>
                        <input type="text" name='organization[<?= \app\models\Organization::ogrn ?>]'
                               value="<?=\app\lib\Request::post('organization')['ogrn'];?>"
                               class="form-control" placeholder="ОГРН" aria-describedby="basic-addon2">
                        <br>
                        <input type="text" name='organization[<?= \app\models\Organization::oktmo ?>]'
                               value="<?=\app\lib\Request::post('organization')['oktmo'];?>"

                               class="form-control" placeholder="ОКТМО" aria-describedby="basic-addon2">
                        <br>
                        <input type="submit" class="form-control">
                    </form>
                </div>
            </div>
            <div class="box-footer"></div>
        </div>
    </div>
</div>
