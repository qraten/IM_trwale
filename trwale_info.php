

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/BrowserPrint-1.0.4.min.js"></script>
<script type="text/javascript" src="js/DevDemo.js"></script>

<script type="text/javascript">
$(document).ready(setup_web_print);
</script>
<table width="100%" height="100%"border="0" style="background-color:#D8D8D8;">

<?php

ini_set('display_errors','off');
require_once 'config.php';
$conn = oci_connect($username, $password, $database);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$stid = oci_parse($conn, "
SELECT INWEN_ID, inwen_nr_wks, INWEN_NAZWA, INWEN_OPIS, INWEN_NR_ZEW, INWEN_NR_DOWP, INWEN_NR_DOWW, inwen_nr_fabr, inwen_dt_prod, rok_prod,  MIEJSC_NAZWA 
FROM st_karto_inwen inwe, st_sl_miejsc miej WHERE  
ROK_SL = $rok AND inwe.MIEJSC_KOD = miej.MIEJSC_KOD and inwen_id =   ".$_GET["inwen_id"]."
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


$inwen = $row[INWEN_ID];
if(strlen($inwen) == 5){
$inwen = "ST-0000$inwen";
}elseif (strlen($inwen) == 4){
$inwen = "ST-00000$inwen"; 
}elseif (strlen($inwen) == 3){
$inwen = "ST-000000$inwen";
}elseif (strlen($inwen) == 2){
$inwen = "ST-0000000$inwen";
}elseif (strlen($inwen) == 1){
$inwen = "ST-00000000$inwen"; 
}else {
}
$miejsce = _no_pl($row[MIEJSC_NAZWA]);
$nazwa = _no_pl(substr($row[INWEN_NAZWA], 0, 30));
$nazwa2 = _no_pl(substr($row[INWEN_NAZWA], 30, 60));
$nr_zew = $row[INWEN_NR_ZEW];
$nr_fab = $row[INWEN_NR_FABR];
$nr_ks = $row[INWEN_NR_KOL];
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

?>
<tr >
<td><FONT FACE='Geneva, Arial' SIZE=4><b><?php echo $row[NAZWA_TOW]?></b> (<?php echo $row[FAKT_NR]?>) 
<a href='trwale.php?inwen_id=<?php echo $row[INWEN_ID];?>' >drukuj</a></font>
<br>Nazwa skr.: <?php echo substr($row[INWEN_NAZWA], 0, 30);?>
<br><?php echo substr($row[INWEN_NAZWA], 30, 60);?>
<br>Rok produkcji: <?php echo $row[ROK_PROD];?>
<br>Opis: <?php echo $row[INWEN_OPIS];?>
<br>Nr fabryczny: <?php echo $row[INWEN_NR_FABR];?>
<br>Nr inwenta¿owy: <?php echo $row[INWEN_NR_ZEW];?>
<br>Nr ks. inwent. 001-<?php echo $row[INWEN_NR_WKS];?>
<br>EAN: <?php 
$inwen = $row[INWEN_ID];
if(strlen($inwen) == 5){
echo "ST-0000$inwen"; 
}elseif (strlen($inwen) == 4){
echo "ST-00000$inwen"; 
}elseif (strlen($inwen) == 3){
echo "ST-000000$inwen"; 
}elseif (strlen($inwen) == 2){
echo "ST-0000000$inwen"; 
}elseif (strlen($inwen) == 1){
echo "ST-00000000$inwen"; 
}else {
} ?>
<br>Miejsce u¿ytkowania: <?php echo $row[MIEJSC_NAZWA]?>
<br>

<div class="navbar navbar-inverse " role="navigation">
    <div class="container">
      <div class="navbar-header">
      
        <a class="navbar-brand" href="#"><p style="font-size: 150%;">Drukowanie etykiet Caparo Polska</p></a>
        <script type="text/javascript">
var OSName="Unknown OS";
if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
//{
//OSName="Windows";
//document.write('<a href="ZebraWebPrint.exe" class="navbar-brand" href="#">Download the '+OSName+' App</a>');
//}
if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";

        </script>
			
      </div><!-- /navbar-header -->
    </div><!-- /container -->
  </div><!-- /navigation -->
  <div class="container" style="width:500px">
    <div id="main">
      <div id="printer_data_loading" style="display:none"><span id="loading_message">Loading Printer Details...</span><br/>
        <div class="progress" style="width:100%">
          <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
          </div>
        </div>
      </div> <!-- /printer_data_loading -->
      <div id="printer_details" style="display:none">
        <span id="selected_printer">No data</span> 
        <button type="button" class="btn btn-success" onclick="changePrinter()">Change</button>
      </div><br /> <!-- /printer_details -->
      <div id="printer_select" style="display:none">
        Zebra Printer Options<br />
        Printer: <select id="printers"></select>
      </div> <!-- /printer_select -->
	  <div id="print_form" style="display:none">
        Enter Name: <input type="text" id="entered_name" value="<?php echo $label?>" ></input>
        <br /><br />
        <button type="button" class="btn btn-lg btn-primary" onclick="sendData();" value="Print">Drukuj etykietê</button>
      </div> <!-- /print_form -->
	
    </div> <!-- /main -->
    <div id="error_div" style="width:500px; display:none"><div id="error_message"></div>
      <button type="button" class="btn btn-lg btn-success" onclick="trySetupAgain();">Try Again</button>
    </div><!-- /error_div -->
	</div><!-- /container -->


</td>
</tr>



<?php
}
oci_free_statement($stid);
oci_close($conn);
?>
</table>
