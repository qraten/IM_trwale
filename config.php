<?Php
///////// Database Details , add  here  ////
$dbhost_name = "localhost";
$database = "ADM";  // Your database name
$username = "sysadm";                  //  Login user id 
$password = "*****_***";                  //   Login password
/////////// End of Database Details //////
$rok = date("Y")-1;

//////// Do not Edit below /////////
try {
///////////$dbo = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
$dbo = new PDO('oci:charset=utf8;dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}



?> 