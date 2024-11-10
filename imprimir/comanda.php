<?php
date_default_timezone_set('America/Lima');
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
$hora = date("g:i:s A");
$fecha = date("d/m/y");

require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$data = json_decode($_GET['data'],true);
$connector = new WindowsPrintConnector("smb://".$data['nombre_pc']."/".$data['nombre_imp']);
// $connector = new WindowsPrintConnector("smb://DESKTOP-MSE9FOD/CAJA");

$printer = new Printer($connector);

try {
  	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	
	if($data['codigo_anulacion'] == 1){
		// $printer -> setTextSize(1,1);
		$printer -> text("***************\n");
		$printer -> text("ANULADO\n");
		$printer -> text("***************\n");
		$printer -> selectPrintMode();
	}
		
	if($data['pedido_tipo'] == 1){
		$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		//$printer -> text("*RESTAURANT BOCAU*\n"); //aqui poner nombre del restaurante en caso desee que salga en la comanda
		//$printer -> text("======================================\n");
		$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$printer -> text("MESA\n");
	}elseif($data['pedido_tipo'] == 2){
		$printer -> text("======================================\n");
		$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$printer -> text("MOSTRADOR\n");
	}elseif($data['pedido_tipo'] == 3){
		$printer -> text("======================================\n");
		$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$printer -> text("DELIVERY\n");
	}
	
	if($data['codigo_anulacion'] <> 1){
		$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$printer -> text("Comanda #".$data['correlativo_imp']."\n");
		$printer -> selectPrintMode();
		$printer -> text("======================================\n");
	}
	
	$printer -> setJustification(Printer::JUSTIFY_RIGHT);
	//$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
	$printer -> text("".$fecha." - ".$hora."\n");
	if($data['pedido_tipo'] == 1){
		$printer -> text($data['pedido_numero']." - ".$data['pedido_cliente']."\n");
		$printer -> text("MOZO:".$data['pedido_mozo']."\n");
	}elseif($data['pedido_tipo'] == 2){
		$printer -> text("LLEVAR #".$data['pedido_numero']." - CLIENTE:".$data['pedido_cliente']."\n");
	}elseif($data['pedido_tipo'] == 3){
		$printer -> text("DELIVERY #".$data['pedido_numero']." - CLIENTE:".$data['pedido_cliente']."\n");
	}
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> text("________________________\n");
	$printer -> text("\n");
	$printer -> setJustification(Printer::JUSTIFY_LEFT);
	foreach ($data['items'] as $value) {
		$printer -> setEmphasis(true);
		$printer -> text($value['cantidad']." | ".$value['producto']." | ".$value['presentacion']."\n");
		$printer -> text(" *".$value['comentario']."\n");
	}
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> text("________________________\n");
	$printer -> text("************************\n");
	$printer -> text("\n");
	$printer -> cut();
	$printer -> close();

} catch(Exception $e) {
	echo "No se pudo imprimir en esta impresora " . $e -> getMessage() . "\n";
}
?>
echo "<script lenguaje="JavaScript">window.close();</script>";

