<?php

//Load dependencies
require __DIR__.'/vendor/autoload.php';

//Namespace of the class
use Spipu\Html2Pdf\Html2Pdf;

if( isset($_POST['crear'])){
  //Import file "view.php"
  ob_start();
  require_once 'pdf.php';
  $html = ob_get_clean();

  $html2pdf = new Html2Pdf('P','','es','true','UTF-8');
  $html2pdf->writeHTML($html);
  $html2pdf->output("calculos-hipotecarios.pdf");
}

if( isset($_POST['calcular'])){
  //Variables
  $deuda = $_POST['credito'];
  $anos = $_POST["anos"];
  $interes = $_POST["interes"];
  $totalint = 0;
  $downpayment = "";

  if(isset($_POST['downpayment'])){
    $downpayment = floatval($_POST['downpayment']);
    $downpayment = $downpayment * $deuda / 100;
    $deuda = $deuda - $downpayment;
    $capitalInicial = $deuda + $downpayment;
  }


  // hacemos los calculos...
  $interes = ($interes/100)/12;
  $m = ($deuda * $interes * (pow((1+$interes),($anos*12))))/((pow((1+$interes),($anos*12)))-1);

  //Mostramos los resultados
  echo '<br><p style="text-align:center">'.'Capital inicial: '.number_format($capitalInicial,2,',','.').'$
  <br>
  Down Payment: '.number_format($downpayment,2,',','.').'$
  <br>
  Cuota a pagar mensualmente: '.number_format($m,2,',','.').'$
  </p>';

  //Tabla
  echo '<div id="resultado">
  <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr>

          <th>Mes</th>

          <th>Intereses</th>

          <th>Amortización</th>

          <th>Cuota Mensual</th>

          <th>Capital Pendiente</th>

      </tr>
    </thead>';

    // mostramos todos los meses...

    for ($i = 1; $i <= $anos * 12 ; $i++) {

        echo "<tr>";

            echo "<td>".$i."</td>";

            $totalint = $totalint + ( $deuda * $interes );

            //Intereses
            echo "<td>".number_format($deuda * $interes,2,",",".")."$</td>";

            //Amortización
            echo "<td>".number_format($m - ( $deuda * $interes),2,",",".")."$</td>";

            //Cuot mensual
            echo "<td>".number_format($m,2,',','.').'$</td>';

            //Deuda
            $deuda = $deuda-($m - ( $deuda * $interes));

            if ($deuda<0) {

                echo "<td>0$</td>";

            } else {

                echo "<td>".number_format($deuda,2,",",".")."$</td>";

            }

        echo "</tr>";

    }

    echo '</table>
</div>

<br>
<p style="text-align:center">Pago total de intereses: '.number_format($totalint,2,",",".").'$</p>';

}

?>


<head>
    <title>Calculadora Hipotecaria</title>

    <style type="text/css">
    /* Tabla */
    table{
      text-align: center;
      margin: auto;
      width: 90%;
      background-color: white;
      border-collapse: collapse;
    }

    thead{
      background-color: #23282e;
      color: white;
      border-bottom: solid 5px #000;
    }

    th, td{
      padding: 10px;
    }

    /* Formulario */
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
      color: #23282e;
      width: 100%;
      outline: none;
      padding: 15px;
      background: none;
      border: none;
      border-bottom: 2px solid #F1CB3F;
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
      color: #D9AB00;
      position: relative;
      padding: 5px 15px 5px 51px;
      font-size: 1em;
      border-radius: 5px;
      -webkit-transition: all 0.3s ease;
      -o-transition: all 0.3s ease;
      transition: all 0.3s ease;
    }

      .formulario .radio label:hover{
        background: rgba(35, 40, 46, 0.26);
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
        border: 3px solid #D9AB00;
      }

    .formulario input[type="radio"] {display: none;}

    .formulario input[type="radio"]:checked + label:before {display: none;}

    .formulario input[type="radio"]:checked + label {
      padding: 5px 15px;
      background: #23282E;
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
                <span><input type="text" placeholder="$" name="credito" maxlen(%)gth=9 placeholder="Ingresa la cantidad" value="<?php echo $_POST["credito"]?>" /></span>
              </div>

              <p style="color: #000;">¿Cuanto tiempo necesitas para pagar?</p>
    					<br>
              <div class="radio">
							    <input type="radio" name="anos" id="anos15" value="15" checked>
							    <label for="anos15">15 años</label>

							    <input type="radio" name="anos" id="anos20" value="20">
							    <label for="anos20">20 años</label>

							    <input type="radio" name="anos" id="anos30" value="30">
							    <label for="anos30">30 años</label>
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
               <p><input type="submit" name="calcular" value="CALCULAR" id="btn-calcular"></p>
             </div>

             <div>
               <p><input type="submit" name="crear" value="GENERAR PDF" id="btn-pdf"></p>
             </div>
</form>
</div>
</div>
</body>
