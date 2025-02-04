<?php
include("setup.php");

$dirsrc=$base."src/";
$dirimg=$base."img/";
$dirmd5=$base."md5/";

echo "<head><style>body {background-color: #F9F4B7;}</style></head>";

if(isset($_FILES['myfile']['tmp_name'])){
  $myname=randomname(12);
  rename($_FILES['myfile']['tmp_name'],$dirsrc.$myname);
  $tipo=exif_imagetype($dirsrc.$myname);
  if($tipo==2){
    $ff=file_get_contents($dirsrc.$myname);
    $mymd5=md5($ff);
    if(file_exists($dirmd5.$mymd5)){
      echo "<h1>Foto gia' presente</h1>";
      unlink($dirsrc.$myname);
    }
    else {
      file_put_contents($dirmd5.$mymd5,$myname);
      $exif=exif_read_data($dirsrc.$myname);
      $orientation=$exif["Orientation"];
      $src=imagecreatefromjpeg($dirsrc.$myname);
      switch($orientation){
        case 2:
          imageflip($src,IMG_FLIP_HORIZONTAL);
          break;
        case 3:
          $src=imagerotate($src,180,0);
          break;
        case 4:
          imageflip($src,IMG_FLIP_VERTICAL);
          break;
        case 5:
          $src=imagerotate($src,-90,0);
          imageflip($src,IMG_FLIP_HORIZONTAL);
          break;
        case 6:
          $src=imagerotate($src,-90,0);
          break;
        case 7:
          $src= imagerotate($src,90,0);
          imageflip($src,IMG_FLIP_HORIZONTAL);
          break;
        case 8:
          $src=imagerotate($src,90,0);
          break;
      }
      $width=imagesx($src);
      $height=imagesy($src);
      $myy=(int)($height/($width/1000));
      $tmp=imagecreatetruecolor(1000,$myy);
      imagecopyresampled($tmp,$src,0,0,0,0,1000,$myy,$width,$height);
      imagejpeg($tmp,$dirimg.$myname,70);
      echo "<h1>Grazie, foto caricata</h1>";
    }
  }
else {
    echo "<h1>Formato non ammesso</h1>";
    unlink($dirsrc.$myname);
  }
}

echo "<a href='https://www.ff25.it'>Torna ad Album Foto</a><br><br>";
echo "<form method=\"post\" enctype=\"multipart/form-data\">";
echo "<input type=\"file\" name=\"myfile\">";
echo "<button type=\"submit\" name=\"run\">Carica</button>";
echo "</form>";

echo "Le foto che carichi sono visualizzate nell'album $album.<br>";
echo "Sono accettate solo ed esclusivamente foto in formato JPEG, ogni altro formato non viene processato.<br>";
echo "Caricando la foto autorizzi $chi alla loro riproduzione in Internet e su supporti cartacei.<br>";
echo "Caricando la foto autorizzi $chi alla loro conservazione.<br>";
echo "La finalita' e' raccontare il percorso passato e futuro di $album.<br>";
echo "A parte la foto, non viene conservato sul sistema nessun'altra tipologia di dato personale.<br>";
echo "Il sistema non effettua alcuna profilazione e non utilizza nessun cookie.<br>";
echo "$chi possono eliminare qualsiasi foto dalla galleria, quando lo ritengono opportuni.<br>";

function randomname($len){
  list($usec,$sec)=explode(' ',microtime());
  srand($sec+$usec*1000000);
  for($i=0;$i<$len;$i++){
    for(;;){
      $nn=rand(48,122);
      if($nn>=58&&$nn<=64)continue;
      if($nn>=91&&$nn<=96)continue;
      $qq[$i]=chr($nn);
      break;
    }
  }
  return implode($qq);
}

?>

