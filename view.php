<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Resultado PDF</title>
    <style>
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

    <?php if(isset($_POST['credito'])): ?>
      <p style="text-align:center">
        Capital inicial: <?=$_POST['credito']?>$ <br>
        Down Payment: $ <br>
        Cuota a pagar mensualmente: $
      </p>
    <?php endif; ?>

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
          <tr>
            <td>1</td>
            <td>2,50%</td>
            <td>40,48$</td>
            <td>959,52$</td>
          </tr>
        </tbody>
    </table>

    <p style="text-align:center">Págo total de intereses: $</p>

  </body>
</html>
