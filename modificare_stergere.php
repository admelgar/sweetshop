<?
  include("autorizare.php");
  include("admin_top.php");
?>

<h1>Edit/Delete Sweet Things</h1>

  <p><b>Note:</b>You can not delete a category if it's an item in it. <br>Before you delete a category you have to modify the item
  so that it belongs to another brand. <br>
  Also you can't delete brand if there exists an item in the tabels of that brand.
 </p>

<div style="width:600px; border:3px solid #632415; 
   back-ground-color:#F9F1E7; padding:5px">

<b>Select the category you want to edit or delete:</b>
<hr size="1">

<form action="formulare_modificare_stergere.php" method="POST">
  Category:
  <select name="id_category">


   <?
     $sql = "select * from categories order by category asc";
     $resursa = mysql_query($sql);
     while($row = mysql_fetch_array($resursa))
     {
          print '<option value="'.$row['id_category'].'">'.$row['category'].'</option>';
     }
   ?>

  </select>

  <INPUT type="submit" id="submit" name="edit_category" value="Edit">
  <INPUT type="submit" id="submit" name="delete_category" value="Delete">
</form>
</div>

<div style="width:600px; border:3px solid #632415; 
   back-ground-color:#F9F1E7; padding:5px">

<b>Select the brand that you want to edit/delete:</b>
<hr>
<form action="formulare_modificare_stergere.php" method="POST">
  brand:
  <select name="id_brand">

  /*afisam si lista drop-down cu brands*/

  <?
    $sql = "select * from brands order by brand asc";
    $resursa = mysql_query($sql); 
    while($row = mysql_fetch_array($resursa))
    {
        print '<option value="'.$row['id_brand'].'">'.$row['brand'].'</option>';
    }
  ?> 
 </select> 

<INPUT type="submit" id="submit" name ="edit_brand" value="edit">
<INPUT type="submit" id="submit" name ="delete_brand" value="delete">

</form>
</div>

<div style="width:600px; border:3px solid #632415; 
   back-ground-color:#F9F1E7; padding:5px">

<b>Select the brand and write the item that you want to edit/delete:</b>
<hr>
<form action="formulare_modificare_stergere.php" method="POST">
 <table>
   <tr>
    <td>brand</td>
    <td>
     <select name="id_brand">

       <?

	/*afisam si lista drop-down cu brands*/

	$sql = "select * from brands order by brand asc";
	$resursa = mysql_query($sql); 
	while($row = mysql_fetch_array($resursa))
	{
	    print '<option value="'.$row['id_brand'].'">'.$row['brand'].'</option>';
	}

       ?> 
     </select> 
   </td>
  </tr> 
  <tr><td>Item:</td>
      <td><INPUT type="text" name="item"></td>
  </tr> 
 </table> 
    <INPUT type="submit" id="submit" name="edit_item" value="edit"> 
    <INPUT type="submit" id="submit" name="delete_item" value="delete">      
 </form>

</div>

</body> 
</html>
