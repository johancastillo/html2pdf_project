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
  </body>
</html>
