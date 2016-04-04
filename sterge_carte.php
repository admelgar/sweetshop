
 if(isset($_POST['sterge_carte']))
 {
   print "<h1>Sterge carte</h1>";

   /* cautam intai o carte in tabela care are titlul si id_autor specificate in 
      formular
   */

   $sqlCarte = "select * from carti where titlu='".$_POST['titlu']."' and 
   				    id_autor=".$_POST['id_autor'];
 
   $resursaCarte = mysql_query($sqlCarte);

   /* daca nu s-a gasit nici o carte care sa corespunda datelor introduse atisam 
      un mesaj de eroare 
   */

   if(mysql_num_rows($resursaCarte) == 0)
   {
	print "Aceasta carte nu exista in tabela";
   }else{
  	/* iar daca exista atunci extragem id_ul cartii din tabela si il vom folosi 
                intr-un camp ascuns din formularul de confirmare */

   $id_carte = mysql_result($resursaCarte,0,"id_carte");

 ?>

Esti sigur ca vrei sa stergi aceasta carte ?

<form action="prelucrare_modificare_stergere.php" method="POST">
   <INPUT type="hidden" name="id_carte" value ="<?=$_POST['id_carte']?>">
   <INPUT type="submit" name="sterge_carte" value="Sterge!"> 
</form>

<?
 }
}
?>