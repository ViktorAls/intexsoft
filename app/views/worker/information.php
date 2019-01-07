<div class="row">
    <div class="col-md-6">
        <div class="tree">
            <ul>
                <li>
                    <a href="#">
                        <p>
                            <b><?= $items['user']['middlename'] ?> <?= $items['user']['firstname'] ?> <?= $items['user']['lastname'] ?></b>
                        </p>
                        <p><b>Дата рожения: </b> <?= $items['user']['birthday'] ?></p>
                        <p><b>СНИЛС: </b><?= $items['user']['snils'] ?></p>
                        <p><b>ИНН: </b><?= $items['user']['inn'] ?></p>
                    </a>
                    <ul>
						<?php foreach ($items['organization'] as $item): ?>
                            <li>
                                <a href="#">
                                    <p><b><?= $item['displayName'] ?></b></p>
                                    <p><b>Ставка: </b><?= $item['rate'] ?></p>
                                    <p><b>ОГРН: </b><?= $item['ogrn'] ?></p>
                                    <p><b>ОКТМО:</b> <?= $item['oktmo'] ?></p>
                                </a>
                            </li>
						<?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <form action="/worker/information" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="middlename">Фамилия</label>
                        <input type="text" value="<?= $items['user']['middlename'] ?>" class="form-control"
                               id="middlename" name="worker[<?=\app\models\worker::middlename?>]">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname">Имя</label>
                        <input type="text" value="<?= $items['user']['firstname'] ?>" class="form-control"
                               id="firstname" name="worker[<?=\app\models\worker::firstname?>]">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname">Отчество</label>
                        <input type="text" value="<?= $items['user']['lastname'] ?>" class="form-control" id="lastname"
                               name="worker[<?=\app\models\worker::lastname?>]">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="birthday">Дата рождения</label>
                        <input type="date" value="<?= $items['user']['birthday'] ?>" class="form-control" id="date"
                               name="worker[<?=\app\models\worker::birthday?>]">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="snils">СНИЛС</label>
                        <input type="text" value="<?= $items['user']['snils'] ?>" class="form-control" id="snils"
                               name="worker[<?=\app\models\worker::snils?>]">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inn">ИНН</label>
                        <input type="text" value="<?= $items['user']['inn'] ?>" class="form-control" id="inn"
                               name="worker[<?=\app\models\worker::inn?>]">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success btn-block">Изменить</button>
                </div>
            </div>
        </form>
    </div>
</div>