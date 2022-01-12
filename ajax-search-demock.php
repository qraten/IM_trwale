<?Php
ini_set('display_errors','off');
//***************************************
// This is downloaded from www.plus2net.com //
/// You can distribute this code with the link to www.plus2net.com ///
//  Please don't  remove the link to www.plus2net.com ///
// This is for your learning only not for commercial use. ///////
//The author is not responsible for any type of loss or problem or damage on using this script.//
/// You can use it at your own risk. /////
//*****************************************
//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);
require "config.php";  // database connection
//////////
//////////////////////////////// Main Code sarts /////////////////////////////////////////////


$in=$_GET['txt'];
//if(!ctype_alnum($in)){
//echo "Data Error";
//exit;
//}
			

$msg="";
$msg.="<table border='1' >";
$msg.="<tr><th>Nazwa</th><th>nr zewn</th><th>numer inwentarzowy</th><th>rok prod</th><th>Wskaznik</th><th>miejsce uzytkowania</th></tr>";




if(strlen($in)>4 and strlen($in) <20 ){
$sql="
SELECT INWEN_ID, inwen_nr_wks, SUBSTR(INWEN_NAZWA, 1,30) AS INWEN_NAZWA, INWEN_OPIS, INWEN_NR_ZEW, INWEN_NR_DOWP, INWEN_NR_DOWW, inwen_nr_fabr, inwen_dt_prod, rok_prod,  MIEJSC_NAZWA, 
 case inwen_wsk when 5 then 'Wylaczony z amortyzacji' when 4 then 'Przeniesiony' when 3 then 'Sprzedany' when 2 then 'Umorzony' when 1 then 'Zlikwidowany' when 0 then 'Czynny' else 'xxx' end inwen_wsk
FROM st_karto_inwen inwe, st_sl_miejsc miej WHERE  inwen_wsk <> 1 and
ROK_SL = $rok AND inwe.MIEJSC_KOD = miej.MIEJSC_KOD  and  (upper(inwen_nr_zew) LIKE UPPER('%$in%') OR upper(MIEJSC_NAZWA) LIKE UPPER('%$in%'))

order BY miej.MIEJSC_NAZWA, inwe.INWEN_NAZWA
";



foreach ($dbo->query($sql) as $nt) {
//$msg.=$nt[name]."->$nt[id]<br>";
$msg .="<tr onMouseOut=\"this.style.backgroundColor = ''\" onMouseOver=\"this.style.backgroundColor = '#fffcd3'\">
<td onClick=\"document.getElementById('ifr2').src='trwale_info.php?inwen_id=$nt[INWEN_ID]'\"  width='400'>$nt[INWEN_NAZWA] </td>
<td width='150'>$nt[INWEN_NR_ZEW]</td><td width='100'> $nt[INWEN_NR_WKS]</td><td width='100'> $nt[ROK_PROD]</td><td width='100'> $nt[INWEN_WSK]</td><td width='100'> $nt[MIEJSC_NAZWA]</td><td onClick=\"document.getElementById('ifr2').src='trwale.php?inwen_id=$nt[INWEN_ID]'\">Drukuj teraz</td></tr>";


}
}
$msg .="</table>";



$dbo = null;

echo $msg;
?>