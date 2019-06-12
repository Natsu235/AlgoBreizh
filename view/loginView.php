<!-- Authentification -->

<?php $this->title = "S'authentifier"; ?>

<div class="row">
	<div class="col-md-12">
		<div class="modal-dialog" style="margin-bottom:0">
			<div class="modal-content">
				<div class="panel-heading">
					<h3 class="panel-title">S'authentifier</h3>
				</div>
				<div class="panel-body">
					<form role="form" action="index.php?action=login" method="POST">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Code Client" name="username" required="" autofocus="" />
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mot de passe" name="password" type="password" value="" />
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me" />Se souvenir de moi
								</label>
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
