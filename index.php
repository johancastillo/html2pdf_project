<?php

//Load dependencies
require __DIR__.'/vendor/autoload.php';

//Namespace of the class
use Spipu\Html2Pdf\Html2Pdf;

if( isset($_POST['crear'])){
  //Import file "view.php"
  ob_start();
  require_once 'view.php';
  $html = ob_get_clean();

  $html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
  $html2pdf->writeHTML($html);
  $html2pdf->output("calculos-hipotecarios.pdf");
}


?>

<form action="" method="post">
  <input type="text" placeholder="Titulo" name="titulo" value="" />
  <input type="submit" name="crear" value="Crear PDF" />
</form>
