<!-- Template du site -->

<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="title" content="AlgoBreizh Store" />
  <meta name="description" content="A shopping website for the fictive company AlgoBreizh" />
  <meta name="author" content="Dorian Pilorge, Quentin Martinez, Paul Besret" />

  <title>AlgoBreizh - <?= $title ?></title>
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />

  <!-- AlgoBreizh Stylesheets -->
  <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/jquery.dataTables.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/algobreizh.css" type="text/css" />

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" style="padding: 10px;" href="#"><img src="assets/img/AlgoBreizh_Logo_48px.png" alt="AlgoBreizh" /></a>
      </div>
      <div id="myNavbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.php"><b>AlgoBreizh</b></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
  		  <?php
			// Interface des utilisateurs
			if ($admin == false && $logged) {
				echo '<li><a href="index.php?action=products" style="color: white;"><span class="glyphicon glyphicon-shopping-cart"></span> Boutique</a></li>';
				echo '<li><a href="index.php?action=cart" style="color: white;"><span class="glyphicon glyphicon-lock"></span> Mon Panier</a></li>';
				echo '<li><a href="index.php?action=orders" style="color: white;"><span class="glyphicon glyphicon-credit-card"></span> Mes Commandes</a></li>';
			}
			// Interface des téléprospecteurs
			else if ($admin && $logged) {
				echo '<li><a href="index.php?action=products" style="color: white;"><span class="glyphicon glyphicon-shopping-cart"></span> Boutique</a></li>';
				echo '<li><a href="index.php?action=orders" style="color: white;"><span class="glyphicon glyphicon-search"></span> Voir Commandes</a></li>';
			}
			// Interface des invités
			else {
				echo '<li><a href="index.php?action=register" style="color: white;"><span class="glyphicon glyphicon-pencil"></span> S\'enregistrer</a></li>';
			}
		  ?>
          <li><a href="index.php?action=<?= ($logged ? 'logout' : 'login') ?>" class="login" <?= ($logged ? 'data-toggle="tooltip" data-placement="bottom" title="Session: "' : '') ?> style="color: <?= ($logged ? 'orangered' : 'lawngreen') ?>;"><span class="<?= ($logged ? 'glyphicon glyphicon-log-out' : 'glyphicon glyphicon-log-in') ?>"></span> <?= ($logged ? 'Déconnexion' : 'Connexion') ?></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <div style="height: 80px;"></div>
  <h1 class="pageTitle">&#11162; <?= $title ?></h1>
    <div class="container">
      <div class="row" id="content">
        <?= $content ?>
      </div>
    </div>
  <div style="height: 140px;"></div>

  <!-- Footer -->
  <footer id="footer" class="navbar navbar-default navbar-fixed-bottom">
    <table>
      <tr>
        <td><img id="logo" src="assets/img/AlgoBreizh_Logo_128px.png" alt="AlgoBreizh" /></td>
        <td>
          <b>AlgoBreizh</b> - SARL au capital de 100 000 euros<br/>
          18, rue de Molene, 29810 LAMPAUL-PLOUARZEL<br/>
          Tel. 02.98.97.96.95 - Mail. www.algobreizh.com / info@algobreizh.com
        </td>
      </tr>
    </table>
  </footer>

  <!-- AlgoBreizh Scripts -->
  <script src="assets/js/jquery/jquery-3.4.0.js" type="text/javascript"></script>
  <script src="assets/js/bootstrap/bootstrap.js" type="text/javascript"></script>
  <script src="assets/js/algobreizh.js" type="text/javascript"></script>
  <?= $scripts ?>

</body>

</html>
