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

    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/tabla.css">
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="css/estilos.css">

    <!-- Iconos de Font Awesome -->
    <script src="https://kit.fontawesome.com/5da0232ac8.js" crossorigin="anonymous"></script>

    <!-- Button to up -->
    <link rel="stylesheet" href="css/toup.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/toup.js"></script>
</head>


<body>


  <!-- Navbar -->
  <div class="fixed-top navegacion">
  <div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4">
      <a class="navbar-brand" href="#">
        <img src="img/logo-casa.png" width="90" height="64" class="d-inline-block align-top" alt="" loading="lazy">

      </a>
      <br>
      <span><a href="http://tucasapropiaenatlanta.com/">Inicio</a></span><br>
      <span><a href="http://tucasapropiaenatlanta.com/tucasapropia/">Tu Casa Propia</a></span><br>
      <span class="text-white"><a href="http://tucasapropiaenatlanta.com/category/inmuebles/">Encuentra Tu Hogar</a></span><br>
      <span class="text-white"><a href="http://tucasapropiaenatlanta.com/category/blog/">Blog</a></span><br>
      <span class="text-white"><a href="http://tucasapropiaenatlanta.com/ser-pre-aprobado/">Ser Pre-aprobado</a></span><br>
      <span class="text-white"><a href="http://tucasapropiaenatlanta.com/contactar-agente/">Quiero Contactar un Agente</a></span><br>
      <span class="text-white"><a href="http://tucasapropiaenatlanta.com/calculadora-hipotecaria/">Calculadora Hipotecaria</a></span>
    </div>
  </div>
  <nav class="navbar navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
</div>

<br>

  <div class="container-fluid mt-4">
    <div class="row justify-content-center">

        <div class="col-lg-6 mt-4">
          <img src="img/banner.png" alt="" style="width: 460px;height: 740px;">
        </div>

        <div class="col-lg-6">
          <!-- Formulario -->
        <div class="contenedor-formulario">
          		<div class="wrap">
                  <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST" class="formulario" style="width: 100%;margin: auto;"
                    name="formulario_registro">

                    <div>
                      <p style="color: #000;">¿Cuanto cuesta la casa que quieres?</p>
                      <br>
                      <div class="input-group">
                        <span>
                          <input type="text" placeholder="$" name="credito" maxlen(%)gth=9 placeholder="Ingresa la cantidad" value="<?php echo $_POST["credito"]?>" />
                        </span>
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
        </div>

    </div>
  </div>
</div>

<!-- Botón de ir arriba -->
<span class="ir-arriba fas fa-sort-up"></span>

  <!-- Footer -->
<footer class="page-footer font-small blue bg-dark">

  <!-- Copyright -->
  <div class="footer-copyright text-center text-white py-3">© 2020 Copyright</div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

      <script src="js/bootstrap.js"></script>
</body>
