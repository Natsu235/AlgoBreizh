<?php

require_once 'manager/orderManager.php';
define('FPDF_FONTPATH','fpdf181/font');
require('invoice.php');

function printOrder($orderId){
//Informations sur la commande
$orderManager = new OrderManager();
$customerManager = new CustomerManager();

$tot_prods = array();
$orderContent = array();
$order = $orderManager->get($orderId);
$orderContent = $order->content();
$client = $customerManager->get($order->customer()->id());
$date = date('d/m/Y');
$endDate = date('d/m/Y', strtotime('+1 month'));

// Informations sur le client
$clientFullname = $client->firstName() . ' ' . $client->lastName();
$clientAddress = '1337 Rue Elon Musk\n75000 PARIS';

// Création PDF + dimensions
$pdf = new PDF_Invoice('P', 'mm', 'A4');
$pdf->AddPage();

// Fournisseur (AlgoBreizh)
$pdf->addSociete(
    'AlgoBreizh',
    '18, rue de Molene\n' .
    '29810 LAMPAUL-PLOUARZEL\n' .
    'R.C.S. RENNES B 000 000 007\n' .
    'Capital : 18000 ' . EURO
);
$pdf->fact_dev('Facture', str_pad($_GET['orderId'], 8, '0', STR_PAD_LEFT));
$pdf->addDate($date);

// Client
$pdf->addClient($clientFullname);
$pdf->addPageNumber('1');
$pdf->addClientAdresse($clientFullname . "\n" . $clientAddress);
$pdf->addReglement('Chèque');
$pdf->addEcheance($endDate);
$pdf->addNumTVA('FR888777666');

// Préparation de la page
$cols = array(
    'REFERENCE'    => 23,
    'DESIGNATION'  => 74,
    'QUANTITE'     => 22,
    'P.U. HT'      => 26,
    'MONTANT H.T.' => 30,
    'TVA'          => 15
);
$pdf->addCols($cols);

$cols = array(
    'REFERENCE'    => 'L',
    'DESIGNATION'  => 'L',
    'QUANTITE'     => 'C',
    'P.U. HT'      => 'R',
    'MONTANT H.T.' => 'R',
    'TVA'          => 'C'
);
$pdf->addLineFormat($cols);
$pdf->addLineFormat($cols);

$y = 109;

 /* 
 Pour chaque item dans la commande, on récupère les élements suivant :
 - Reference
 - Nom de l'article
 - Prix unitaire hors taxes
 - Quantité commandée de cet item
 */
for($i = 0; $i < count($orderContent); $i++){

    $reference = strval($orderContent[$i]->reference());
    $name = utf8_decode($orderContent[$i]->name());
    $price = floatval($orderContent[$i]->price());
    $quantity = floatval($orderContent[$i]->quantity());

    // Affichage des informations de la commande sur l'item courant
    $line = array( 
    "REFERENCE"    => strval($reference),
    "DESIGNATION"  => strval($name),
    "QUANTITE"     => strval($quantity),
    "P.U. HT"      => strval($price),
    "MONTANT H.T." => strval($price * $quantity),
    "TVA"          => "19.6%" );

// Préparation de la prochaine ligne
$size = $pdf->addLine( $y, $line );
$y += $size + 2;

// Mise à jour des données pour le calcul du total
$this_prod = array("px_unit" => $price, "qte" => $quantity, "tva" => 1);
array_push($tot_prods, $this_prod);

}

// Application TVA et affichage
$tab_tva = array( "1" => 19.6, "2" => 5.5);
$pdf->addCadreTVAs();
$params  = array( "RemiseGlobale" => 0,
                  "FraisPort"     => 0,
                  "AccompteExige" => 0,
                  "Remarque" => "" );

$pdf->addTVAs($params, $tab_tva, $tot_prods);
$pdf->addCadreEurosFrancs();

// Sortie du ficher PDF
$pdf->Output();
}

?>
