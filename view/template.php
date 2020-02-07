<!-- Template du site -->

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="title" content="AlgoBreizh Store">
  <meta name="description" content="A shopping website for the fictive company AlgoBreizh">
  <meta name="author" content="Dorian Pilorge, Quentin Martinez, Paul Besret">
  <title>AlgoBreizh - <?= $title ?></title>
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/datatables/DataTables-1.10.20/js/jquery.dataTables.min.js" type="text/css">
  <link rel="stylesheet" href="assets/css/algobreizh.css" type="text/css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-dark shadow">
    <a class="navbar-brand" href="index.php">
      <img src="assets/img/AlgoBreizh_Logo_48px.png" width="48" height="30" alt="">&nbsp;Algo<strong>Breizh</strong>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <?php
        // Interface des utilisateurs
        if ($admin == false && $logged) {
          echo '<li class="nav-item"><a class="nav-link" href="index.php?action=products"><span class="glyphicon glyphicon-shopping-cart"></span> Boutique</a></li>';
          echo '<li class="nav-item"><a class="nav-link" href="index.php?action=cart"><span class="glyphicon glyphicon-lock"></span> Mon Panier</a></li>';
          echo '<li class="nav-item"><a class="nav-link" href="index.php?action=orders"><span class="glyphicon glyphicon-credit-card"></span> Mes Commandes</a></li>';
        }
        // Interface des téléprospecteurs
        else if ($admin && $logged) {
          echo '<li class="nav-item"><a class="nav-link" href="index.php?action=products"><span class="glyphicon glyphicon-shopping-cart"></span> Boutique</a></li>';
          echo '<li class="nav-item"><a class="nav-link" href="index.php?action=orders"><span class="glyphicon glyphicon-search"></span> Voir Commandes</a></li>';
        }
        // Interface des visiteurs
        else {
          echo '<li class="nav-item"><a class="nav-link text-success" href="index.php?action=register"><span class="glyphicon glyphicon-pencil"></span> S\'inscrire</a></li>';
        }
        ?>
        <li><a href="index.php?action=<?= ($logged ? 'logout' : 'login') ?>" class="login" <?= ($logged ? 'data-toggle="tooltip" data-placement="bottom" title="Session: "' : '') ?> style="color: <?= ($logged ? 'orangered' : 'lawngreen') ?>;"><span class="<?= ($logged ? 'glyphicon glyphicon-log-out' : 'glyphicon glyphicon-log-in') ?>"></span> <?= ($logged ? 'Déconnexion' : 'Connexion') ?></a></li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <!-- View -->
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
          <b>AlgoBreizh</b> - SARL au capital de 100 000 euros<br>
          18, rue de Molene, 29810 LAMPAUL-PLOUARZEL<br>
          Tel. 02.98.97.96.95 - Mail. www.algobreizh.com / info@algobreizh.com
        </td>
      </tr>
    </table>
  </footer>
  <!-- Scripts -->
  <script src="assets/vendor/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
  <script src="assets/vendor/popper/popper.min.js" type="text/javascript"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/algobreizh.js" type="text/javascript"></script>
  <?= $scripts ?>
</body>

</html>
