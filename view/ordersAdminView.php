<!-- Commandes clients -->

<?php $this->title = "Commandes clients"; ?>

  <div class="row">
	<table id="orderTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Date</th>    
				<th>N° Commande</th>
				<th>Justificatif</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($orders as $order): ?>
			<tr>
				<td><?= $order->creationDate() ?></td>
				<td><?php 		$idFormated = str_pad($order->Id(), 8, '0', STR_PAD_LEFT);
					echo '<a href="index.php?action=order&order='.$order->Id().'".</a>'.$idFormated.'</td>';
					?>
				<td><a href="index.php?action=generatePdf&orderId=<?= $order->id() ?>">PDF</a></td>
				<?php
					if ($order->state() == 1) {
						echo '<td class="center" style="color: green;">Traîtée</td>';
					}
					else if ($order->state() == 2) {
						echo '<td class="center" style="color: red;">Annulée</td>';
					}
					else {
						echo '<td class="center"><a class="btn btn-sm btn-success" href="index.php?action=valid&orderId='.$order->id().'">Valider</a></td>';
					}		
				?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
  </div>

<?php ob_start(); ?>
  <script src="assets/js/jquery/jquery.dataTables.js" type="text/javascript"></script>
  <script src="assets/js/ordersAdmin.js" type="text/javascript"></script>
<?php $this->scripts = ob_get_clean(); ?>
