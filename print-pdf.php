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

  $html2pdf = new Html2Pdf('P','','es','true','UTF-8');
  $html2pdf->writeHTML($html);
  $html2pdf->output("calculos-hipotecarios.pdf");
}


?>

<!-- Formulario -->
<form action="" method="post">
  <input type="text" placeholder="Crédito" name="credito" value="" /><br>
  <input type="text" placeholder="Años de hipoteca" name="anos" value="" /><br>
  <input type="text" placeholder="Tasa de intereses" name="intereses" value="" /><br>
  <input type="submit" name="crear" value="Crear PDF" />
</form>
