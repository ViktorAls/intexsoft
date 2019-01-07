<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Изменить огранизацию</h3>
			</div>
			<div class="box-body">
				<div>
					<?php
					$keyOrganization = key($items['organization']);
					?>
					<form action="/admin/organization/update?id=<?=$keyOrganization?>" method="post">
                        <input type="text" value="<?=$items['organization'][$keyOrganization]['displayName']?>" name = 'organization[<?=\app\models\Organization::displayName?>]' class="form-control" placeholder="Название предприятия" aria-describedby="basic-addon2">
						<br>
						<input type="text" value="<?=$items['organization'][$keyOrganization]['ogrn']?>" name = 'organization[<?=\app\models\Organization::ogrn?>]' class="form-control" placeholder="ОГРН" aria-describedby="basic-addon2">
						<br>
						<input type="text" value="<?=$items['organization'][$keyOrganization]['oktmo']?>" name = 'organization[<?=\app\models\Organization::oktmo?>]' class="form-control" placeholder="ОКТМО"  aria-describedby="basic-addon2">
						<br>
						<input type="submit" class="form-control" >
						
					</form>
				</div>
			</div>
			<div class="box-footer"></div>
		</div>
	</div>
</div>
