<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Изменить рабочего</h3>
			</div>
			<div class="box-body">
				<div>
					<?
						$keyWorker = key($items['worker']);
					?>
					<form action="/admin/worker/update?id=<?=$keyWorker?>" method="post">
					
					<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="middlename">Фамилия</label>
									<input type="text" value="<?= $items['worker'][$keyWorker]['middlename'] ?>" class="form-control"
									       id="middlename" name="worker[<?=\app\models\worker::middlename?>]">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="firstname">Имя</label>
									<input type="text" value="<?= $items['worker'][$keyWorker]['firstname'] ?>" class="form-control"
									       id="firstname" name="worker[<?=\app\models\worker::firstname?>]">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lastname">Отчество</label>
									<input type="text" value="<?= $items['worker'][$keyWorker]['lastname'] ?>" class="form-control" id="lastname"
									       name="worker[<?=\app\models\worker::lastname?>]">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="birthday">Дата рождения</label>
									<input type="date" value="<?= $items['worker'][$keyWorker]['birthday'] ?>" class="form-control" id="date"
									       name="worker[<?=\app\models\worker::birthday?>]">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="snils">СНИЛС</label>
									<input type="text" value="<?= $items['worker'][$keyWorker]['snils'] ?>" class="form-control" id="snils"
									       name="worker[<?=\app\models\worker::snils?>]">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="inn">ИНН</label>
									<input type="text" value="<?= $items['worker'][$keyWorker]['inn'] ?>" class="form-control" id="inn"
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
			<div class="box-footer"></div>
		</div>
	</div>
</div>
