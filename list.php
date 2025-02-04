<?php

if($_GET["login"]!="melX6iy9LnKy3DkU")exit(0);
$myd=$_POST["myd"];
if(strlen($myd)==12){
  echo "Cencellata $myd\n";
  unlink("img/$myd");
}

echo "<pre>";
$base="/home/www/corteconnessa/";
$photo=scandir($base."img",SCANDIR_SORT_DESCENDING);
echo "<form method='post'>";
for($i=0;;$i++){
  if($photo[$i]=="." || $photo[$i]=="..")break;
  printf("%03d ",$i+1);
  echo "<img src='img/$photo[$i]' style='width: 200px; height: auto; vertical-align: middle; '>";
  $dd=date("Y-m-d H:i:s",filectime($base."img/".$photo[$i]));
  printf(" %12s %s ",$photo[$i],$dd);
  echo "<button type='submit' name='myd' value='$photo[$i]'>Delete</button>";
  echo "<br>\n";
}
echo "</form>";

?>
