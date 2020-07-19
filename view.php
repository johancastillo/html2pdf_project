<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Resultado PDF</title>
    <style>
      /* Tabla */
      table{
        text-align: center;
        margin: auto;
        width: 100%;
        background-color: white;
        border-collapse: collapse;
      }
      th, td{
        padding: 10px;
      }

    </style>
  </head>
  <body>
    <img style="width:100%; height:100px" src="./img/barra.jpg">
    <h1 style="text-align:center">Calculos Hipotecarios</h1>

    <?php if(isset($_POST['credito'])){
      //Variables
      $deuda = $_POST['credito'];
      $anos = $_POST["anos"];
      $interes = $_POST["interes"];
      $totalint = 0;

      // hacemos los calculos...
      $interes = ($interes/100)/12;
      $m = ($deuda * $interes * (pow((1+$interes),($anos*12))))/((pow((1+$interes),($anos*12)))-1);

      //Mostramos los resultados
      echo '<p style="text-align:center">'.'Capital inicial: '.number_format($deuda,2,',','.').'$
      <br>
      Down Payment: $
      <br>
      Cuota a pagar mensualmente: '.number_format($m,2,',','.').'$
      </p>';
    }?>



  <table cellspacing="0" cellpadding="5" border="1">

      <thead>
        <tr>

            <th>Mes</th>

            <th>Intereses</th>

            <th>Amortización</th>

            <th>Capital Pendiente</th>

        </tr>
      </thead>
        <tbody>
          <?php

          // mostramos todos los meses...

          for ($i = 1; $i <= $anos * 12 ; $i++) {

              echo "<tr>";

                  echo "<td>".$i."</td>";

                  $totalint = $totalint + ( $deuda * $interes );

                  //Intereses
                  echo "<td>".number_format($deuda * $interes,2,",",".")."</td>";

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
        </tbody>
    </table>

    <p style="text-align:center">Pago total de intereses: <?php echo number_format($totalint,2,",",".")?> $</p>

  </body>
</html>
