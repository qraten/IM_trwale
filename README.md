# IM_trwale
Drukowanie naklejek dla środków trwałych - IM

Do poprawnego działania niezbędne kilka rzeczy:
1. XAMPP na Windows lub Apache na Linux z dostępem do bazy danych
2. Drukarka Zebra USB + zainstalowany program Broswer Print dla Windows
3. Drukarka Zebra z LAN 
   dla drukarki LAn nalezy ustawić /* IP drukarki ZEBRA. */
   plik trwale.php 94 linijka     $host = "192.168.7.105";
3. Należy ustawić rok w pliku config.php:    $rok = date("Y");  lub dać $rok = date("Y")-1;  + login i hasło do bazy.
4. Etykiety drukuje na drukarce ZEBRA GK420t z wykorzystaniem folii i termotransferu
