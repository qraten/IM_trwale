# IM_trwale
Drukowanie naklejek dla środków trwałych - IM

Do poprawnego działania niezbędne kilka rzeczy:
1. Drukarka Zebra USB + zainstalowany program Broswer Print dla Windows
2. Drukarka Zebra z LAN 
   dla drukarki LAn nalezy ustawić /* IP drukarki ZEBRA. */
   plik trwale.php 94 linijka     $host = "192.168.7.105";
3. Nalezy ustawić rok w pliku config.php:    $rok = date("Y");  lub dać $rok = date("Y")-1;
