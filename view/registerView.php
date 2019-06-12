<!-- Inscription -->

<?php $this->title = "S'inscrire"; ?>

<div class="row">
	<div class="col-md-12">
		<div class="modal-dialog" style="margin-bottom:0">
			<div class="modal-content">
				<div class="panel-heading">
					<h3 class="panel-title">S'inscrire</h3>
				</div>
				<div class="panel-body">
					<form role="form" action="index.php?action=register" method="POST">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Code Client" name="username" required="" autofocus="" />
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Email" name="email" required="" />
							</div>
							<!-- Change this to a button or input when using this as a form -->
							<input type="submit" value="Connexion" class="btn btn-sm btn-success" />
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
