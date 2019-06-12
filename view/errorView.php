<!-- Erreur -->

<?php $this->title = "Erreur"; ?>

        <div class="center">
          <br />
          <h1><img src="assets/img/danger.png" style="width: 50px; height: 50px;" />&nbsp; Algo<b>Breizh</b> - Erreur !</h1>
          <br />
          <br />
          <p>
            <?= $message ?><br /><br />
          </p>
          <br />
          <br />
          <button class="btn btn-sm btn-success" onclick="location.reload()"><span class="glyphicon glyphicon-repeat"></span> RÃ©essayer</button> &nbsp; 
          <button class="btn btn-sm btn-secondary" onclick="window.history.back()"><span class="glyphicon glyphicon-chevron-left"></span> Retour</button>
        </div>

        <!-- Désactive la molette -->
        <style type="text/css">
          html, body {
            overflow: hidden;
          }
        </style>

<?php ob_start(); ?>
<script src="assets/js/error.js"></script>
<?php $this->scripts = ob_get_clean(); ?>
