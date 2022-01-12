<?php
ini_set('display_errors','off');
require_once 'config.php';

$conn4 = oci_connect($username, $password, $database);
if (!$conn4) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$stid = oci_parse($conn4, "
SELECT INWEN_ID, inwen_nr_wks, INWEN_NAZWA, INWEN_OPIS, INWEN_NR_ZEW, INWEN_NR_DOWP, INWEN_NR_DOWW, inwen_nr_fabr, inwen_dt_prod, rok_prod,  MIEJSC_NAZWA 
FROM st_karto_inwen inwe, st_sl_miejsc miej WHERE  
ROK_SL = $rok AND inwe.MIEJSC_KOD = miej.MIEJSC_KOD and inwen_id =   ".$_GET["inwen_id"]."
AND inwen_nr_doww IS null  AND krst_kod NOT IN ('104', '106', '109', '110', '030', '032', '220', '211', '291', '900', '222')
order BY miej.MIEJSC_NAZWA, inwe.INWEN_NAZWA
");
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {


function _no_pl($tekst)
{
  $tabela = Array(
  //WIN
"xb9" => "a", "xa5" => "A", "xe6" => "c", "xc6" => "C",
"xea" => "e", "xca" => "E", "xb3" => "l", "xa3" => "L",
"xf3" => "o", "xd3" => "O", "x9c" => "s", "x8c" => "S",
"x9f" => "z", "xaf" => "Z", "xbf" => "z", "xac" => "Z",
"xf1" => "n", "xd1" => "N",
  //UTF
"xc4x85" => "a", "xc4x84" => "A", "xc4x87" => "c", "xc4x86" => "C",
"xc4x99" => "e", "xc4x98" => "E", "xc5x82" => "l", "xc5x81" => "L",
"xc3xb3" => "o", "xc3x93" => "O", "xc5x9b" => "s", "xc5x9a" => "S",
"xc5xbc" => "z", "xc5xbb" => "Z", "xc5xba" => "z", "xc5xb9" => "Z",
"xc5x84" => "n", "xc5x83" => "N",
  //POLSKIE
"œ" => "s", "Œ" => "S", "Æ" => "C", "æ" => "c",  "£" => "L", "³" => "l", 
"ó" => "o", "ê" => "e", "¿" => "z", "¯" => "Z", "" => "Z", "Ÿ" => "z", 
"Ñ" => "N", "ñ" => "n",  "¹" => "a", 
  //ISO
  "xb1" => "a", "xa1" => "A", "xe6" => "c", "xc6" => "C",
"xea" => "e", "xca" => "E", "xb3" => "l", "xa3" => "L",
"xf3" => "o", "xd3" => "O", "xb6" => "s", "xa6" => "S",
"xbc" => "z", "xac" => "Z", "xbf" => "z", "xaf" => "Z",
"xf1" => "n", "xd1" => "N");

  return strtr($tekst,$tabela);
}
?>

<table width="100%" border="0">
<br>Nazwa skr.: <?php echo _no_pl(substr($row[INWEN_NAZWA], 0, 30));?>
<br><?php echo substr($row[INWEN_NAZWA], 30, 60);?>
<br>Rok produkcji: <?php echo $row[ROK_PROD];?>
<br>Opis: <?php echo $row[INWEN_OPIS];?>
<br>Nr fabryczny: <?php echo$row[INWEN_NR_FABR];?>
<br>Nr inwenta¿owy: <?php echo $row[INWEN_NR_ZEW];?>
<br>Nr ks. inwent. 001-<?php echo $row[INWEN_NR_WKS];?>
<br>EAN: <?php 
$inwen = $row[INWEN_ID];
if(strlen($inwen) == 5){
echo "ST-0000$inwen";
$inwen = "ST-0000$inwen";
}elseif (strlen($inwen) == 4){
echo "ST-00000$inwen"; 
$inwen = "ST-00000$inwen"; 
}elseif (strlen($inwen) == 3){
echo "ST-000000$inwen"; 
$inwen = "ST-000000$inwen";
}elseif (strlen($inwen) == 2){
echo "ST-0000000$inwen";
$inwen = "ST-0000000$inwen";
}elseif (strlen($inwen) == 1){
echo "ST-00000000$inwen"; 
$inwen = "ST-00000000$inwen"; 
}else {
} ?>
<br>Miejsce u¿ytkowania: <?php echo $row[MIEJSC_NAZWA];?>
<br><br>


<?php
$miejsce = _no_pl($row[MIEJSC_NAZWA]);
$nazwa = _no_pl(substr($row[INWEN_NAZWA], 0, 30));
$nazwa2 = _no_pl(substr($row[INWEN_NAZWA], 30, 60));
$nr_zew = $row[INWEN_NR_ZEW];
$nr_fab = $row[INWEN_NR_FABR];
$nr_ks = $row[INWEN_NR_WKS];
//$inwen = 0;
error_reporting(E_ALL);
/* Port dla serwisu. */
$port = "9100";

/* IP drukarki ZEBRA. */
$host = "192.168.7.105";

/* konstrukcja druku */

$label = "CT~~CD,~CC^~CT~";
$label .= "^XA~TA000~JSN^LT0^MNW^MTT^PON^PMN^LH0,0^JMA^PR2,2~SD22^JUS^LRN^CI0^XZ";
$label .= "^XA";
$label .= "^MMT";
$label .= "^PW599";
$label .= "^LL0360";
$label .= "^LS0";
$label .= "^BY3,3,40^FT26,163^BCN,,Y,N";
$label .= "^FD$inwen^FS";
$label .= "^FT21,28^A0N,20,28^FH\^FDMiejsce:^FS";
$label .= "^FT21,53^A0N,19,36^FH\^FD$miejsce^FS";
$label .= "^FT0,96^XG000.GRF,1,1^FS";
$label .= "^FT20,117^A0N,28,40^FH\^FD$nazwa2^FS";
$label .= "^FT21,86^A0N,28,40^FH\^FD$nazwa^FS";
$label .= "^FT288,32^A0N,28,40^FH\^FDSzpital Sandomierz^FS";
$label .= "^FT26,220^A0N,23,24^FH\^FDNr fab.: $nr_fab^FS";
$label .= "^FT26,247^A0N,23,24^FH\^FDNr zewn.: $nr_zew^FS";
$label .= "^PQ1,0,1,Y^XZ";
$label .= "^XA^ID000.GRF^FS^XZ";

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error    ()) . "\n";
} else {
    echo "<b>Drukowanie:</b> \n";
}

echo "Po³¹czy³em siê z '$host' na porcie '$port'";
$result = socket_connect($socket, $host, $port);
if ($result === false) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror    (socket_last_error($socket)) . "\n";
} else {
    echo "<br> Wydruk OK.\n";
}

socket_write($socket, $label, strlen($label));
socket_close($socket);

?>
</table>
<?php
}
oci_free_statement($stid);
oci_close($conn4);
?>
