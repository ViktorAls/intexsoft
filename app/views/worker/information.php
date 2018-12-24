
<div class="tree">
    <div class="col-md-12 col-md-offset-5">
        <ul>
            <li>
                <a href="#">
                    <p><b><?=$items['user']['middlename']?> <?=$items['user']['firstname']?> <?=$items['user']['lastname']?></b></p>
                    <p><b>Дата рожения: </b> <?=$items['user']['birthday']?></p>
                    <p><b>СНИЛС: </b><?=$items['user']['snils']?></p>
                    <p><b>ИНН: </b><?=$items['user']['inn']?></p>
                </a>
                <ul>
                    <?foreach ($items['organization'] as $item):?>
                    <li>
                        <a href="#">
                            <p><b><?=$item['displayName']?></b></p>
                            <p><b>Ставка: </b><?=$item['rate']?></p>
                            <p><b>ОГРН: </b><?=$item['ogrn']?></p>
                            <p><b>ОКТМО:</b> <?=$item['oktmo']?></p>
                        </a>
                    </li>
                    <?endforeach;?>
                </ul>
            </li>
        </ul>
    </div>
</div>