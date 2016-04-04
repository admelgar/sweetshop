<?
  session_start();
  include("autorizare.php");
  include("admin_top.php");
?>

<h1>Add Sweet Things</h1>

 <b>Add Category</b>
  <form action="prelucrare_adaugare.php" method="POST">
   Category Name : <INPUT type="text" name="category_name">
	         <INPUT type="submit" id="submit" name="add_category" value="Add">
  </form>
 
 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <b>Add Brand</b>
  <form action="prelucrare_adaugare.php" method="POST">
     &nbsp;&nbsp;&nbsp;&nbsp;
     Brand Name : <INPUT type="text" name="brand_name">
	         <INPUT type="submit" id="submit" name="add_brand" value="Add">
  </form>

 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <b>Add Item</b>
  <form action="prelucrare_adaugare.php" method="POST">
   <table>
    <tr>
     <td>Category</td>
     <td>
     <select name="id_category">
	/*luam namele de domenii din tabela si le afisam utilizatorului intr_o 
	lista drop_down. Putem astfel obtine un id_domeniu corespunzator 
	domeniului selectat pe care sa-l introducem in tabelul cartii
	*/
      <?
        $sql="select * from categories order by category asc";
        $sursa=mysql_query($sql);
        while($row=mysql_fetch_array($sursa))
	{
	  print '<option value="'.$row['id_category'].'">'
				 .$row['category']
		.'</option>';
        }
      ?>
     </select>
    </td>
   </tr>

   <tr>
     <td>Brand:</td>
     <td>
     <select name="id_brand">
	/*afisam lista drop_down cu autori*/
      <?
        $sql="select * from brands order by brand asc";
        $sursa=mysql_query($sql);
        while($row=mysql_fetch_array($sursa))
        {
	  print '<option value="'.$row['id_brand'].'">'.$row['brand']
		.'</option>';
        }
      ?>
     </select>
    </td>
   </tr>

   <tr>
     <td>Item:</td>
     <td><input type="text" name="item"></td>
    </tr>
 
    <tr>
     <td align="top">Description: </td>
     <td><textarea name="description" rows="8">
         </textarea>
     </td>
    </tr>
    
    <tr>
     <td>Price: </td>
     <td><input type="text" name="price"></td>
    </tr>
    <tr>
     <td></td>
     <td><INPUT type="submit" id="submit" name="add_item" value="Add"></td>
    </tr>
   </table>
  </form>
</div>
 </body>
</html>