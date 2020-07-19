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
<head>
    <title>Calculadora Hipotecaria</title>

    <style type="text/css">
    body{
      background:#f2f2f2; font-family:"Roboto"; border-top: 30px solid #23282e; margin: 0;
    }

    .contenedor-formulario{
      width: 100%; padding: 50px 0;
    }

    .input-group {
      position: relative; margin-bottom: 32px;
    }

    input[type="text"]{
      font-family: "Roboto";
      font-size: 16px;
      color: #e05a00;
      width: 100%;
      outline: none;
      padding: 15px;
      background: none;
      border: none;
      border-bottom: 2px solid #BBDEFB;
    }

    .input-group label {color: #ffc900; }

    .wrap {
      width: 90%;
      max-width: 1000px;
      margin: auto;
      padding: 40px;
      background: #fff;
      box-shadow: 0px 0px 3px grey;
    }

    .formulario .radio label{
      display: inline-block;
      cursor: pointer;
      color: #FF4136;
      position: relative;
      padding: 5px 15px 5px 51px;
      font-size: 1em;
      border-radius: 5px;
      -webkit-transition: all 0.3s ease;
      -o-transition: all 0.3s ease;
      transition: all 0.3s ease;
    }

      .formulario .radio label:hover{
        background: rgba(255, 65, 54, 0.1);
      }

      .formulario .radio label:before {
        content: "";
        display: inline-block;
        width: 17px;
        height: 17px;
        position: absolute;
        left: 15px;
        border-radius: 50%;
        background: none;
        border: 3px solid #FF4136;
      }

    .formulario input[type="radio"] {display: none;}

    .formulario input[type="radio"]:checked + label:before {display: none;}

    .formulario input[type="radio"]:checked + label {
      padding: 5px 15px;
      background: #F1CB3F;
      border-radius: 2px;
      color: #fff;
    }

    #btn-calcular{
          background: #f1cb3f;
          border-radius: 1px;
          border: 2px solid #f2f2f2;
          color: #fff;
          cursor: pointer;
          display: inline-block;
          font-family: "Roboto";
          font-size: 16px;
          padding: 15px;
          width: 100%;
          -webkit-transition: all 0.3s ease;
          -o-transition: all 0.3s ease;
          transition: all 0.3s ease;
    }

    #btn-calcular:hover {
        background: #f3bf00;
    }

    #btn-pdf{
          background: #23282e;
          border-radius: 1px;
          border: 2px solid #f2f2f2;
          color: #fff;
          cursor: pointer;
          display: inline-block;
          font-family: "Roboto";
          font-size: 16px;
          padding: 15px;
          width: 100%;
          -webkit-transition: all 0.3s ease;
          -o-transition: all 0.3s ease;
          transition: all 0.3s ease;
    }

    #btn-pdf:hover {
        background: #081731;
    }

    </style>
</head>

<!-- Form -->
<body>
<div class="contenedor-formulario">
  		<div class="wrap">
          <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST" class="formulario" style="width: 100%;margin: auto;"
            name="formulario_registro">

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
							    <input type="radio" name="downpayment" id="hombre" value="3.5" checked>
							    <label for="hombre">3,5%</label>

							    <input type="radio" name="downpayment" id="mujer" value="5">
							    <label for="mujer">5%</label>

							    <input type="radio" name="downpayment" id="alien" value="10">
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
</body>
