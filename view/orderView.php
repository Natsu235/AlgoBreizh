<!-- Mes commandes -->

<?php $this->title = "Mes commandes"; ?>

  <div class="row">
	<table id="orderTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Date</th>    
				<th>N° Commande</th>
				<th>Facture</th>
				<th>Statut</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($orders as $order): ?>
			<tr>
				<td><?= $order->creationDate() ?></td>
				<td>
				<?php
					$idFormated = str_pad($order->Id(), 8, '0', STR_PAD_LEFT);
					echo '<a href="index.php?action=order&order='.$order->Id().'".</a>'.$idFormated.'</td>';
					if ($order->state() == 1) {
						echo '<td><a href="index.php?action=generatePdf&orderId='.$order->id().'">PDF</a></td>';
						echo '<td><span style="color: green;">Traîtée</span></td>';
					}
					else if ($order->state() == 2) {
						echo '<td>Non disponible</td>';
						echo '<td><span style="color: red;">Annulée</span></td>';
					}
					else {
						echo '<td>Non disponible</td>';
						echo '<td><span style="color: orange;">En attente</span></td>';
					}
				?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
  </div>

<?php ob_start(); ?>
  <script src="assets/js/jquery/jquery.dataTables.js" type="text/javascript"></script>
  <script src="assets/js/orders.js" type="text/javascript"></script>
<?php $this->scripts = ob_get_clean(); ?>
