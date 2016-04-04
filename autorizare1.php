<? 
 session_start();

include("f_autorizare.php");

if(!autorizat())
{
	print 'Acces neautorizat';
	exit;
}

include("meniu.php");
include("main.php");
/*
 /* 
 pornim sesiunea deoarece avem nevoie de datele din ea
 
 verificam datele astfel incat 
 $_SESSION['key_admin'] din index.php sa fie acelasi cu session_id
 */

 if($_SESSION['key_admin'] != session_id())
 {
	print "Acces neautorizat!";
	exit;
 }

 /* 
 ne conectam la baza de date si verificam datele din sesiune cu cele din baza de date 

 include("c:\Document root\conectare.php");
 
 include("conectare.php");
 */

 mysql_connect("localhost", "root", "");
 mysql_select_db("store"); 

 /* 
 verificam daca namele si password salvate in variabile de sesiune 
 sunt aceleasi cu cele din baza de date
 */

 $sql = "select * from admin where 
  	admin_name='".$_SESSION['name_admin']."' and 
  	admin_password='".$_SESSION['password_encriptata']."'";

 $resursa=mysql_query($sql);

 /* 
 daca interogarea este executata cu succes, trebuie sa returneze 
 un singur rand, altfel, vom afisa un mesaj de eroare si vom opri 
 executia scriptului
 */

 if(mysql_num_rows($resursa) != 1)
 {
	print "Acces neautorizat!<br>";
	exit;
 }
*/
?>
