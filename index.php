<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>Calculadora Hipotecaria</title>

      <link rel="stylesheet" href="css/estilos.css">
      <link rel="stylesheet" href="css/tabla.css">
      <link rel="stylesheet" href="css/checkbox.css">
  </head>

<body>

  <div class="contenedor-formulario">
  		<div class="wrap">
          <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST" class="formulario" name="formulario_registro">

            <div>
              <p style="color: #000;">¿Cuanto cuesta la casa que quieres?</p>
              <br>
              <div class="input-group">
                <span><input type="text" name="credito" maxlen(%)gth=9 placeholder="Ingresa la cantidad" value="<?php echo $_POST["credito"]?>"></span>
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

<br>
<br>

<?php

if (isset($_POST["interes"])) {

    // Reemplazamos la posible coma por un punto.
    $_POST["interes"]=str_replace(",",".",$_POST["interes"]);

}

if (

    isset($_POST["credito"]) && is_numeric($_POST["credito"]) &&

    isset($_POST["anos"]) && is_numeric($_POST["anos"]) &&

    isset($_POST["interes"]) && is_numeric($_POST["interes"])
) {

    $deuda = $_POST["credito"];

    $anos = $_POST["anos"];

    $interes = $_POST["interes"];

    $totalint = 0;

    // hacemos los calculos...
    $interes = ($interes/100)/12;
    $m = ($deuda * $interes * (pow((1+$interes),($anos*12))))/((pow((1+$interes),($anos*12)))-1);

    //Mostramos los resultados
    echo '<div><p style="text-align:center">Capital Inicial: '.number_format($deuda,2,',','.').'$</p>';

    echo '<p style="text-align:center">Down Payment: '.'$</p>';

    echo '<p style="text-align:center">Cuota a pagar mensualmente: '.number_format($m,2,',','.').'$</p></div><br>';

    ?>

  <div id="resultado">
    <table border="1" cellpadding="5" cellspacing="0">
      <thead>
        <tr>

            <th>Mes</th>

            <th>Intereses</th>

            <th>Amortización</th>

            <th>Capital Pendiente</th>

        </tr>
      </thead>
        <?php

        // mostramos todos los meses...

        for ($i = 1; $i <= $anos * 12 ; $i++) {

            echo "<tr>";

                echo "<td>".$i."</td>";

                $totalint = $totalint + ( $deuda * $interes );

                //Intereses
                echo "<td>".number_format($deuda * $interes,2,",",".")."%</td>";

                //Amortización
                echo "<td>".number_format($m - ( $deuda * $interes),2,",",".")."$</td>";


                //Deuda
                $deuda = $deuda-($m - ( $deuda * $interes));

                if ($deuda<0) {

                    echo "<td>0$</td>";

                } else {

                    echo "<td>".number_format($deuda,2,",",".")."$</td>";

                }

            echo "</tr>";

        }

        ?>

    </table>
</div>

<br>

    <p style="text-align:center">Pago total de intereses: <?php echo number_format($totalint,2,",",".")?> $</p>

    <?php

}

?>


</body>

</html>
