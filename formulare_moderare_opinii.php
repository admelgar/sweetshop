<?
 include("autorizare.php"); 
 include("admin_top.php");
$id_feedback=$HTTP_POST_VARS['id_feedback'];
 /* formular editre feedback*/ 

 if(isset($_POST['edit']))
 {
   
   $sql = "select * from feedbacks where id_feedback='$id_feedback'";

   $resursa = mysql_query($sql);

   /*fiind returnat un singur rand, nu folosim while */

   $row = mysql_fetch_array($resursa);
?>

<h1>edit</h1>
<b>edit acest feedback</b> 

 <form action="prelucrare_moderare_comentarii.php" method="POST">
   name:
        <input type="text" name="user" value="<?
echo($row['user']);?>"><br>
   Email :
        <input type="text" name="email" value="<? echo($row['email']);?>">
   <br>
   feedback: <br>
        <textarea name="feedback" cols="35" rows="8"><? echo($row['feedback']);?> 
        </textarea><br><br>

        <input type="hidden" name="id_feedback" value="<? echo($id_feedback);?>">
        <input type="submit" id="submit" name="edit" value="edit">
 </form>

<?

}
/* confirmare deletere feedback */ 

if(isset($_POST['delete']))
{

?>

  <h1>delete</h1> 

  Esti sigur ca vrei sa stergi acest feedback?

  <form  action="prelucrare_moderare_comentarii.php" method="POST">
    <input type="hidden" name="id_feedback" value="<?=$_POST['id_feedback']?>">
    <input type="submit" id="submit" name="delete" value="delete"> 
  </form>

<?

}

  /* confirmare moderare*/ 

  if(isset($_POST['set_ok']))
  {

?>

<h1>Set as an OK feedback</h1>

 Are you sure you want to set this feedbacks as OK??<br> 
 Did you checked all?

 <form action="prelucrare_moderare_comentarii.php" method="POST">
   <input type="hidden" name="last_id" value="<?=$_POST['last_id']?>">
   <input type="submit" id="submit" name="set_ok" value="Yes">
 </form>

<?

}

?>

</body>
</html>

