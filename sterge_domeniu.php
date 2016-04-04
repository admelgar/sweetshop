
 if(isset($_POST['delete_category']))
 {
   /* verificam daca sunt carti in tabela care apartin acestui domeniu */

   $sql = "select item,brand from items,brands,categories 
		where items.id_category=categories.id_category and 
                      items.id_brand=".$_POST['id_brand'];
   $resursa = mysql_query($sql);
   $nrItems = mysql_num_rows($resursa);

   /* daca sunt carti apartinand acestui domeniu afisam lista lor si un mesaj de eroare */

   if($nrItems > 0)
   {
	print "<p>There are $nrItems items under this category</p>";
	while($row = mysql_fetch_array($resursa))
	{
  			print "<b>".$row['item']."</b> de ".$row['brand']."<br>";
	}
	print "<p>You can not delete this category </p>";

 }else{

?>

<h1>Delete category</h1> 
	are you sure you want to delete this category?
<form action="prelucrare_modificare_stergere.php" method="POST">
   <INPUT type="hidden" name="id_category" value="<?=$_POST['id_category']?>">
   <INPUT type="submit" id="submit" name="delete_category" value="Delete"> 
</form>

<?
 }
}
?>