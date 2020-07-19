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

<!-- Form -->
<div class="contenedor-formulario">
  		<div class="wrap">
          <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST" class="formulario" name="formulario_registro">

            <div>
              <p style="color: #000;">¿Cuanto cuesta la casa que quieres?</p>
              <br>
              <div class="input-group">
                <span><input type="text" placeholder="Crédito" name="credito" maxlen(%)gth=9 placeholder="Ingresa la cantidad" value="<?php echo $_POST["credito"]?>" /></span>
              </div>

              <p style="color: #000;">¿Cuanto tiempo necesitas para pagar?</p>
    					<br>
    					<div class="input-group">
    						<span><input type="text" name="anos" maxlength=2 placeholder="Años de hipoteca" value="<?php echo $_POST["anos"]?>"></span>
    					</div>

              <p style="color: #000;">Tasa de intereses</p>
    					<br>
    					<div class="input-group">
    						  <span><input type="text" name="interes" placeholder="Tasa de interés(%)" maxlength=9 value="<?php echo $_POST["interes"]?>"></span>
    					</div>

              <p style="color: #000;">Down Payment</p>
					    <br>

					    <div class="radio">
							    <input type="radio" name="sexo" id="hombre" value="<?php echo $_POST[3.5]?>" checked>
							    <label for="hombre">3,5%</label>

							    <input type="radio" name="sexo" id="mujer" value="<?php echo $_POST[5]?>">
							    <label for="mujer">5%</label>

							    <input type="radio" name="sexo" id="alien" value="<?php echo $_POST[10]?>">
							    <label for="alien">10%</label>
					    </div>

					    <br>

             <div>
               <p><input type="submit" value="CALCULAR" id="btn-calcular"></p>
             </div>

             <div>
               <p><input type="submit" name="crear" value="GENERAR PDF" id="btn-pdf"></p>
             </div>
</form>
</div>
</div>
