<?php  $this->title = "Commande N°:".str_pad($order->id(), 8, '0', STR_PAD_LEFT).' Client: '.$order->customer()->firstName().' '.$order->customer()->lastName(); ?>
  <div class="row">
	<table id="orderContentTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th></th>
				<th>Article</th>    
				<th>Prix (unitaire)</th>
				<th>Quantité</th>
			</tr>
		</thead>
		<tbody>
			<?php $totalPrice = 0; ?>
			<?php foreach ($order->content() as $product): ?>
			<tr>
				<td class="center"><img id="article_img_<?= $product->reference(); ?>" height="36" width="36" src="assets/img/products/<?= $product->reference() ?>.jpg"></td>
				<td><?= $product->name() ?></td>
				<td><?= $product->price() ?> €</td>
				<td>x<?= $product->quantity() ?> </td>
			</tr>
			<?php $totalPrice += $product->price() * $product->quantity(); ?>
			<?php endforeach; ?>
		</tbody>
		<tr id="actionsBtn" class="center ">
			<td colspan="5" id="table-footer">
				<br />
				<p style="font-size: 16px;">Prix total: <b style="color: red;"><?= $totalPrice ?> €</b></p>
				<br />
			</td>
		</tr>
	</table>
  </div>

<?php ob_start(); ?>
  <script src="assets/js/jquery/jquery.dataTables.js" type="text/javascript"></script>
  <script src="assets/js/order.js" type="text/javascript"></script>
<?php $this->scripts = ob_get_clean(); ?>
