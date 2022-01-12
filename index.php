<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=windows-1250" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

<style>
.displayDiv { display:inline-block; vertical-align:top; overflow:hidden; border:solid grey 1px; }
.displayDiv select { padding:10px; margin:-5px -20px -5px -5px; }
</style>
<script type="text/javascript">
function ajaxFunction(str)
{
var httpxml;
try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
document.getElementById("displayDiv").innerHTML=httpxml.responseText;
document.getElementById("msg").style.display='none';
      }
    }
	var url="ajax-search-demock.php";
url=url+"?txt="+str;
url=url+"&sid="+Math.random();
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
document.getElementById("msg").innerHTML="Proszę czekać ...";
document.getElementById("msg").style.display='inline';
  }
  
$('#name').change(function() {
    $('#entered_name').val($(this).val());
});
function updateInput(ish) {
   document.getElementById("fieldname").value = ish;
}
</script>
</head>


<body style="background-color:#D8D8D8; font-size:24px;">
<table>
  <tr>
    <td valign="top" width="750">
<div id=msg style="position:absolute; width:300px; height:25px; 
z-index:1; left: 170px; top: 30px; 
border: 1px none #000000"></div>
Wpisz minimum 5 znaków nr inwentarzowego lub nazwę miejsca<br>
<form name="myForm">
<input type="text" onkeyup="ajaxFunction(this.value);" name="username" />
<div id="displayDiv"></div>
</form>
</td>
<td valign="top" width="600" >
<iframe id='ifr2' frameborder="0" scrolling="yes" height="500" width="500" style="background:#D8D8D8;" allowtransparency="true"> </iframe>
</td>
</tr>
</table>
</body>
</html>