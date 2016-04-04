	<form action="prelucrare_modificare_stergere.php" method="POST">
	<table>
  	<tr>
      	  <td>Domeniu</td>
      	  <td><SELECT name="id_domeniu">

          <?

           /* Luam namele de domenii din tabela si Ie afisam utilizatorului intr-o lista drop-   
              down. Obscrvati folosirea lui if pentru a alisa ca selectat domeniul de care apartine  
              cartea
           */

           $sql1 = "select * from domenii order by domeniu asc";
           $resursa1 = mysql_query($sql1);

           while(mysql_fetch_array($resursa1))
           {
	      if($row['id_domeniu'] == $rowCarte['id_domeniu'])
	      {
		print '<option SELECTED value="'.$row['id_domeniu'].'">'
                                                .$row['domeniu']
			.'</option>';
              }else{
		print '<option value="'.$row['id_domeniu'].'">'
				       .$row['domeniu']
			.'</option>';
              }
            }

          ?>

    	 </select>
       </td> 
      </tr> 
      <tr> 
       <td>Autor:</td>
       <td>
        <select name="id_autor"> 
          
        <?

        /* Afisam si lista dropdown cu autori */

        $sql2 = "select * from autori order by autor asc"; 
        $resursa2 = mysql_query($sql2); 
        while($row = mysql_fetch_array($resursa2))
        {
   	   if($row['id_autor'] == $rowCarte['id_autor'])
	   {
      		print '<option SELECTED value="'.$row('id_autor'].'">'
					        .$row['autor']
                     .'</option>';
   	   }else{
		print '<option value="'.$row['id_autor'].'">'
				       .$row['autor']
		     .'</option>';
   	   }
        }

        ?> 

        </select>
      </td> 
     </tr> 
     <tr> 
      <td>Titlu:</td>
      <td> 
         <INPUT type="text" name="titlu" value="<?=$rowCarte['titlu']?>">
      </td>
     </tr> 
     <tr> 
      <td valign = "top"> Descriere: </td>
      <td><textarea name = "descriere" rows="8"><?=$rowCarte['descriere']?>
          </textarea>
      </td>
     </tr> 
     <tr> 
      <td>Pret:</td>
      <td>
	<INPUT type="text° name="pret" value="<?=$rowCarte['pret']?>">
      </td>
     </tr>
   </table> 
    <INPUT type="hidden" name="id_carte" value="<?=$rowCarte['id_carte']?>">
    <INPUT type="submit" id="submit" name="modifica_carte" value="Modifica"> 
 </form>