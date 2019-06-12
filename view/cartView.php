<!-- Mon panier -->

<?php $this->title = "Mon panier"; ?>

  <div class="row">
	<table id="cartTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th></th>    
				<th>Article</th>    
				<th>Prix (unitaire)</th>
				<th>Quantité</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $totalPrice = 0; ?>
			<?php foreach ($cart as $product): ?>
			<tr>
				<td class="center"><img id="article_img_<?= $product->id() ?>" height="36" width="36" src="assets/img/products/<?= $product->reference(); ?>.jpg"></td>
				<td><?= $product->name(); ?></td>
				<td><?= $product->price(); ?> €</td>
				<td>&times;<?= $product->quantity(); ?></td>
				<td class="center" style="width: 30%;">
					<a href="index.php?action=addToCart&productId=<?= $product->id().'&quantity=1&output=0'; ?>" class="btn btn-sm btn-success">+</a>
					<a href="index.php?action=removeFromCart&productId=<?= $product->id(); ?>" class="btn btn-sm btn-danger">-</a>
				</td>
			</tr>
			<?php $totalPrice += $product->price() * $product->quantity(); ?>
			<?php endforeach; ?>
		</tbody>
		<tr id="actionsBtn" class="center">
			<td colspan="5" id="table-footer">
			<?php if (count($cart) >=1){
				echo '<br />
				<p style="font-size: 16px;">Prix total à payer: <b style="color: red;">'.$totalPrice.' €</b></p>
				<br />
				<a href="index.php?action=checkOut" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span> Passer commande</a> &nbsp; 
				<a href="index.php?action=clearCart" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> Vider le panier</a>
			</td>';
			}
			?>
		</tr>
	</table>
  </div>

<?php ob_start(); ?>
  <script src="assets/js/jquery/jquery.dataTables.js" type="text/javascript"></script>
  <script src="assets/js/cart.js" type="text/javascript"></script>
<?php $this->scripts = ob_get_clean(); ?>
