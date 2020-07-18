<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Resultado PDF</title>

    <style type="text/css">

    </style>
  </head>
  <body>
    <?php if(isset($_POST['titulo'])): ?>
      <h1><?=$_POST['titulo']?></h1>
    <?php endif; ?>

    <table border="1">
      <tr>
        <td>Uno</td>
        <td>Dos</td>
        <td>Tres</td>
      </tr>

      <tr>
        <td>Uno</td>
        <td>Dos</td>
        <td>Tres</td>
      </tr>
    </table>
  </body>
</html>
