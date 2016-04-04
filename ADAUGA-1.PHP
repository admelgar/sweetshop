<?

session_start();

/*include("miercuri.php");
include("carte.php");

verifica daca toate campurile formatului au
fost completate, afiseaza un mesaj si intrerupe scriptul
*/

if ($_POST['name_utilizator'] == "" 
	|| $_POST['adresa_email'] == ""
	|| $_POST['comentariu'] == "")
{
	print "Trbuie sa completati toate campurile";
	exit;
}
/*include("conectare.php");*/

mysql_connect("localhost", "root", "");
mysql_select_db("store");

$name=strip_tags($_POST['name_utilizator']);
$email=strip_tags($_POST['adresa_email']);
$coment=strip_tags($_POST['comentariu']);
$sql="INSERT INTO comentarii (id_carte, name_utilizator, adresa_email, comentariu) 
	VALUES(".$_POST['id_carte'].",'".$name."','".$email."','".$coment."')";
/*print "<br>".$sql."<br>";*/
mysql_query($sql);
/* redirectionam utilizatorul catre pagina cartii la care a adaugat un comentariu */ 
$inapoi="carte.php?id_carte=".$_POST['id_carte'];

/*print "<br>".$inapoi.",".$_POST['id_carte']."<br>";*/
$id_carte=$_POST['id_carte'];
header("location: $inapoi");

?>
<?
session_start();
include ("miercuri.php");


?>
