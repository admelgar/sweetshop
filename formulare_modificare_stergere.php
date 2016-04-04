<?
 include("autorizare.php"); 
 include("admin_top.php");


 if(isset($_POST['edit_category']))
 {
   /* we tahe the name of the catefory from the table because it sent only the id.
   */

   $sql= "select category from categories where id_category='".$_POST['id_category']."'";
   $resursa = mysql_query($sql);
   $category = mysql_result($resursa,0,"category");

   /* si afisam namele vechi de category intr-un textbox pentru a fi modificat*/

?>

<h1>edit name category</h1>

<form action="prelucrare_modificare_stergere.php" method="POST">
    <INPUT type="text" name="category" value="<?=$category?>">
    <INPUT type="hidden" name="id_category" value="<?=$_POST['id_category']?>">
    <INPUT type="submit" id="submit" name="edit_category" value="Edit"> 
</form>

<?

}

/*   delete category */

/*include("delete_category.php");*/

 if(isset($_POST['delete_category']))
 {
   /* verificam daca sunt items in tabela care apartin acestui category */

   $sql = "select item, brand from items,brands,categories 
		where items.id_category=categories.id_category and 
                      items.id_brand=brands and 
		      category.id_category=".$_POST['id_category'];
   $resursa = mysql_query($sql);
   $nrItems = mysql_num_rows($resursa);

   /* daca sunt items apartinand acestui category afisam lista lor si un mesaj de eroare */

   if($nrItems > 0)
   {
	print "<p>There are $nrItems items under this category</p>";
	while($row = mysql_fetch_array($resursa))
	{
  			print "<b>".$row['item']."</b> de ".$row['brand']."<br>";
	}
      print "<p>Can't delete this category! </p>";
   }
      /* iar daca nu sunt items in acest category cerem confirmarea pcntru stergere: */
    else{

?>

<h1>Delete categories</h1> 

	are you sure you want to delete this category?

<form action="prelucrare_modificare_stergere.php" method="POST">
   <INPUT type="hidden" name="id_category" value="<?=$_POST['id_category']?>">
   <INPUT type="submit" id="submit" name="delete_category" value="Delete"> 
</form>

<?
 }
}


 /*edit/delete brand

  editre name brand */ 

 if(isset($_POST['edit_brand']))
 {
   /* luam namele brandului din tabela deoarece ne-a fost trimis 
     din formular doar id_brand: 
   */

  $sql = "select brand from brands where id_brand='".$_POST['id_brand']."'";
  $resursa = mysql_query($sql); 
  $brand = mysql_result($resursa, 0, "brand");

  /* 95si afisam namele brandului intr-un textbox pentru a fi editt */

?>

<h1>edit name brand</hl> 

<form action="prelucrare_modificare_stergere.php" method="POST">
   <INPUT type="text" name="brand" value="<?=$brand?>">
   <INPUT type="hidden" name="id_brand" value="<?=$_POST['id_brand']?>">
   <INPUT type="submit" id="submit" name="edit_brand" value="edit"> 
</form>

<?
 }

 /* delete brand */

  if(isset($_POST['delete_brand']))
  {
      /*104 verificam daca sunt items in tabela care apartin acestui brand: */
     
     $sql = "select item from items, brands where items.id_brand=brands.id_brand and
				 items.id_brand=".$_POST['id_brand']; 
     $resursa = mysql_query($sql);
     $nrItems = mysql_num_rows($resursa);

     /* 106 daca sunt items apartinand acestui brand, afisam lista lor si un mesaj de eroare: */

    if($nritems > 0)
    {
	print "<p>Sunt $nrItems items de acest brand in tabela!</p>"; 
	while($row = mysql_fetch_array($resursa))
	{
   		print $row['item']."<br>"; 
	}

	print "<p>Nu puteti delete acest brand:</p>";

    } 
    /* iar daca nu sunt items scrise de acest brand cerem confirmarea pentru deletere */

    else{

?> 

<h1>delete brand</h1>

	Esti sigur ca vrei sa stergi acest brand?

<form action="prelucrare_modificare_stergere.php" method="POST">
   <INPUT type="hidden" name= "id_brand" value="<?=$_POST['id_brand']?>">
   <INPUT type="submit" id="submit" name="delete_brand" value="delete!">
</form>

<?
 }
}

  /*edit/delete item
  editre name item */ 

 if(isset($_POST['edit_item']))
 {
      print "<h1>editre item</h1>";

      /* cautam intai o item care are iteml si id_brand specificate in formular*/

      $sqlItem="select * from items where item='".$_POST['item']."' and 
					 id_brand=".$_POST['id_brand'];
      $resursaItem=mysql_query($sqlItem);

      /*daca nu s-a gasit nici o item care sa corepunda datelor introduse, 
	afisam un mesaj de eroare*/

      if(mysql_num_rows($resursaItem) == 0)
      {
  	print "Aceasta Item nu exista in tabela";
      
      }else{

        /* daca exista, atunci extragem informatiile din resursa, le punem intr-un array 
	  (nu folosim while deoarece este returnat un singur rand!) si le afisam in 
	  formular pentru a fi editte*/

        $rowItem = mysql_fetch_array($resursaItem);
	/*print_r($rowItem);*/
?> 
	<form action="prelucrare_modificare_stergere.php" method="POST">
	<table>
  	<tr>
      	  <td>Category:</td>
      	  <td><SELECT name="id_category">
          <?
           /* Luam namele de categories din tabela si Ie afisam utilizatorului intr-o lista drop-   
              down. Observati folosirea lui if pentru a afisa ca selectat categoryl de care apartine  
              Itema
           */

           $sql="select * from categories order by category asc";
	   $resursa = mysql_query($sql);
           while($row=mysql_fetch_array($resursa))
           {
  	      if($row['id_category'] == $rowItem['id_category'])
	      {
		print '<option SELECTED value="'.$row['id_category'].'">'
                                                .$row['category']
			.'</option>';
              }else{
		print '<option value="'.$row['id_category'].'">'
				       .$row['category']
			.'</option>';
              }
            }

          ?>

    	 </select>
       </td> 
      </tr> 
      <tr> 
       <td>brand:</td>
       <td>
        <select name="id_brand"> 
          
        <?

        /* Afisam si lista dropdown cu brands */

        $sql = "select * from brands order by brand asc"; 
        $resursa = mysql_query($sql); 
        while($row = mysql_fetch_array($resursa))
        {
   	   if($row['id_brand'] == $rowItem['id_brand'])
	   {
		print '<option SELECTED value="'.$row['id_brand'].'">'
                                                .$row['brand']
		     .'</option>';
   	   }else{
		print '<option value="'.$row['id_brand'].'">'
				       .$row['brand']
		     .'</option>';
   	   }
        }

        ?> 

        </select>
      </td> 
     </tr> 
     <tr> 
      <td>item:</td>
      <td> 
         <INPUT type="text" name="item" value="<?=$rowItem['item']?>">
      </td>
     </tr> 
     <tr> 
      <td valign = "top"> Description: </td>
      <td><textarea name = "description" rows="8"><?=$rowItem['description']?>
          </textarea>
      </td>
     </tr> 
     <tr> 
      <td>Price:</td>
      <td>
	<INPUT type="text" name="price" value="<?=$rowItem['price']?>">
      </td>
     </tr>
   </table> 
    <INPUT type="hidden" name="id_item" value="<?=$rowItem['id_item']?>">
    <INPUT type="submit" id="submit" name="edit_item" value="edit"> 
 </form>

 <?
 }
}

 if(isset($_POST['delete_item']))
 {
   print "<h1>Delete item</h1>";

   /* cautam intai o item in tabela care are iteml si id_brand specificate in 
      formular
   */

   $sqlItem = "select * from items where item='".$_POST['item']."' and 
   				    id_brand=".$_POST['id_brand'];
 
   $resursaItem = mysql_query($sqlItem);

   /* daca nu s-a gasit nici o Item care sa corespunda datelor introduse afisam 
      un mesaj de eroare 
   */

   if(mysql_num_rows($resursaItem) == 0)
   {
	print "Can't find item";
   }else{
        /* iar daca exista atunci extragem id_ul itemsi din tabela si il vom folosi 
        intr-un camp ascuns din formularul de confirmare */

   	$id_item = mysql_result($resursaItem, 0, "id_item");
   ?>

      Are you sure you want to delete this item?

  <form action="prelucrare_modificare_stergere.php" method="POST">
    <INPUT type="hidden" name="id_item" value="<?=$id_item?>">
    <INPUT type="submit" id="submit" name="delete_item" value="Delete"> 
  </form>

<?
 }
}
?>

</body>
</html>
