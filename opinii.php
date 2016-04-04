<?
 include("autorizare.php");
 include("admin_top.php"); 
?>

<h1>Edit or delete feedbacks</h1>
<b>Feedbacks since the last set up</b>
<br>
<?
 $sql = "select * from feedbacks, admin, items, brands where 
			id_feedback>admin.ultimul_comentariu_moderat and 
			items.id_item=feedbacks.id_item and 
			items.id_brand=brands.id_brand 
			order by id_feedback asc"; 
 /*print $sql;*/
 $resursa = mysql_query($sql); 

 while($row=mysql_fetch_array($resursa))
 {

?>

  <form action="formulare_moderare_opinii.php" method="POST">

    <div style="width:500px; border:1px solid #ffffff; 
     background-color:#F9F1E7; padding:5px">     

     <b><?=$row['brand']?> <?=$row['item']?></b>
     <hr size="1"> 
      <a href="mailto:<?=$row['email']?>"><?=$row['user']?>
      </a><br>
      <?=$row['feedback']?> 
    </div>

    <INPUT type="hidden" name="id_feedback" value="<?=$row['id_feedback']?>">
    <INPUT type="submit" id="submit" name="edit" value="Edit"> 
    <INPUT type="submit" id="submit" name="delete" value="Delete">
  </form>

<?

 $last_id = $row['id_feedback']; 

 /*Aceasta variabila preia la fiecare iterare cu while a array-ului 
   valoarea id_comentariu, ajungand ca la ultima iterare sa aiba 
   valoarea id-ului ultimului comentariu. 
   Avem nevoie de aceasta valoare astfel incat sa putem seta valoarea 
   campului ultimul_comentariu_moderat din tabelul admit folosind formularul urmator. 
 */

 } 

 /*In continuare vom scrie o structura conditionala.
   Daca sunt colnentarii in lista afisaln formularul si 
   butonul de setare a feedbackslor ca fiind moderate. 
   Daca nu e nici un comentariu in lista vom afis:a doar un mesaj. 
   Astfel evitam erorile care ar putea aparea daca nu avem feedbacks 
   in lista si valoarea variabilei $ultimul_comentariu ar fi nula. 
 */

 $nrFeedbacks=mysql_num_rows($resursa); 

 if($nrFeedbacks > 0)
 { 

?>

<form action="formulare_moderare_opinii.php" method="POST">
 <INPUT type="hidden" name="last_id" value="<?=$last_id?>">
 <INPUT type="submit" id="submit" name="set_ok" value="Set this feedbacks as OK">
</form> 

<?

  }else{
	print "No new feedbacks";
}

?>

</body> 
</html>
