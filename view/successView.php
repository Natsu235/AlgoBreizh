<!-- Succès -->

<?php $this->title = "Succes"; ?>

        <div class="center">
          <br />
          <h1><img src="assets/img/success.png" style="width: 50px; height: 50px;" />&nbsp; Article ajoute avec succes !</h1>
          <br />
          <br />
          <p>L'article a ete ajoute a la boutique avec succes.</p>
          <br />
          <br />
		  <button class="btn btn-sm btn-success" onclick="window.location.href='index.php?action=products'"><span class="glyphicon glyphicon-shopping-cart"></span> Boutique</button> &nbsp; 
          <button class="btn btn-sm btn-secondary" onclick="window.history.back()"><span class="glyphicon glyphicon-chevron-left"></span> Retour</button>
        </div>
		<div style="height: 100px;">
		</div>

        <!-- Désactive la molette -->
        <style type="text/css">
          html, body {
            overflow: hidden;
          }
        </style>

<?php ob_start(); ?>
  <script src="assets/js/error.js" type="text/javascript"></script>
<?php $this->scripts = ob_get_clean(); ?>
