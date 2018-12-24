<div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-4">
        <form class="form-inline" method="post" action="/">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" name="search" id="search" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Поиск</button>
        </form>
    </div>
</div>
<?if (!isset($item['organization'])):?>
    <?foreach ($items['organization'] as $item):?>
        <div class="drop-shadow lifted">
            <p><?=$item['displayName']?></p>
            <div><b>ОГРН:</b> <?=$item['ogrn']?></div>
            <div><b>ОКТМО:</b> <?=$item['oktmo']?></div>
            <div><b>Рабочих:</b> <?=$item['workers']?></div>
        </div>
    <?endforeach;?>
<?else:?>
    <p>Извените, предприятий не найдено.</p>
<?endif;?>
