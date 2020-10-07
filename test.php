<?php 
include_once('header.php');
require 'PHPExcel/Classes/PHPExcel.php';
?>
<div class="container">
	<div class="row">
		<?php
		require('Classes/PHPExcel.php');
require_once 'Classes/PHPExcel/IOFactory.php';
$phpExcel = new PHPExcel;

$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");

$sheet = $phpExcel ->setActiveSheetIndex(0);
$sheet->setTitle('My product list');

$sheet ->getCell('A1')->setValue('Vendor');
$sheet ->getCell('B1')->setValue('Amount');
$sheet ->getCell('C1')->setValue('Cost');
// Making headers text bold and larger
$sheet ->getCell('A2')->setValue('Vendor');

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="file.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
	?>
	</div>
</div>



<?php 
include_once('footer.php');
?>