<?php
include("setup.php");
$act=file_get_contents($base."next");
?>

<head>
<meta http-equiv='refresh' content='6' />
<title>Corte Connessa</title>
<style>
  body {background-color: #F9F4B7;}
</style>
</head>

<body>
<center>
<a href='https://www.corteconnessa.it/up.php'>Upload</a>
&nbsp; &nbsp; &nbsp;
Nome Foto: <?php echo $act; ?>
<br>
</center>
<img src='img/<?php echo $act ?>' style='width: 100%; height: 100%; object-fit: contain;'>
</body>
