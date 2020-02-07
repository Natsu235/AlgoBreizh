<!-- Boutique -->

<?php $this->title = "Articles" ?>

<?php foreach ($products as $product):?>
        <div class="col-md-2">
          <div class="card center">
            <a href="assets/img/products/<?= $product->reference() ?>.jpg" target="_blank">
              <div class="card-image" onmouseover="this.style.cursor='zoom-in'">
                <img id="article_img_<?= $product->id() ?>" class="imageClip" src="assets/img/products/<?= $product->reference() ?>.jpg">
              </div>
            </a>
            <div class="card-content">
              <p id="article_name_<?= $product->id() ?>"> <?= $product->name() ?></p>
            </div>   
            <div class="card-action">
              <p>Prix: <span id="article_price_<?= $product->id() ?>"><?= $product->price() ?></span> €</p>
              <div class="articleBtn">
                <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal" onclick="showProduct(<?= $product->id() ?>)" style="width: 100%;"><span class="glyphicon glyphicon-search"></span> Voir l'article</a>
              </div>
            </div>
          </div>
        </div>
<?php endforeach; ?>

        <!-- Modal d'un article -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_article_title" class="modal-title"><span class="glyphicon glyphicon-info-sign"></span> Sélection de l'article</h4>
              </div>
              <div class="modal-body">
                <div class="card center">
				  <img id="modal_article_img" class="imageClip center" src="assets/img/warning.png" />
				  <input type="hidden" id="modal_article_id" />
				  <div class="card-content">
					<p id="modal_article_name"></p>
				  </div>
                  <div class="card-action center">
                    <p>Prix: <span id="modal_article_price"></span> €</p>
                    <p>Quantité: <input class="control" type="number" min="1" max="10" value="1" id="modal_quantity" name="modal_quantity" style="width: 25%;" onchange="newPrice(document.getElementById('modal_article_id').innerText)"></p>
                  </div>
                </div>
              </div>
              <div class="modal-footer center">
                <button class="btn btn-sm btn-success" data-dismiss="modal" data-target="#myModal2" onclick="addToCart($('#modal_article_id').text());">Ajouter au panier</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal de succès -->
        <div id="myModal2" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_message_title" class="modal-title"><span class="glyphicon glyphicon-ok-circle"></span> Article ajouté</h4>
              </div>
              <div class="modal-body">
                <div>
                  <div class="center">
                    <p id="modal_message_success"></p>
                  </div>
                </div>
              </div>
              <div class="modal-footer center">
                <button class="btn btn-sm btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-shopping-cart"></span> Continuer mes achats</button> &nbsp; 
                <a href="index.php?action=cart" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-lock"></span> Consulter mon panier</a>
              </div>
            </div>
          </div>
		</div>

        <!-- Modal d'erreur -->
        <div id="myModal3" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_message_title" class="modal-title"><span class="glyphicon glyphicon-remove-circle"></span> Erreur</h4>
              </div>
              <div class="modal-body">
                <div>
                  <div class="center">
                    <p id="modal_message_error"><span><img src="assets/img/danger.png" />&nbsp; Une erreur est survenue. Veuillez réesayer ultérieurement.</span></p>
                  </div>
                </div>
              </div>
              <div class="modal-footer center">
                <br />
              </div>
            </div>
          </div>
        </div>

<?php ob_start(); ?>
  <script src="assets/js/jquery/jquery.dataTables.js" type="text/javascript"></script>
  <script src="assets/js/products.js" type="text/javascript"></script>
<?php $this->scripts = ob_get_clean(); ?>
