<?php
include("setup.php");


  $photo=scandir($base."img",SCANDIR_SORT_DESCENDING);
  $act=file_get_contents($base."next");
  $key=array_search($act,$photo);
  $len=count($photo);
  if(++$key>=$len-2)$key=0;
  file_put_contents("next",$photo[$key]);


?>
