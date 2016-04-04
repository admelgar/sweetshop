<?
  include("autorizare.php");
  include("admin_top.php");

/* editre name domeniu */ 

if(isset($_POST['edit']))
{
  /* Verifica sa fie completate campurile */ 
  if($_POST['user']=="")
  {
 	print "Write a username";
  }
   else if($_POST['email']=="")
	{
		print "Write an email address";
	}
	 else if($_POST['feedback']=="")
		{
			print "Write a feedback";
		}
  else
      {
           /*campurile fiind completate sa facem editrea in tabela*/

	   $sql = "update feedbacks set user='".$_POST['user']."',
     		                            email='".$_POST['email']."',
				              feedback='".$_POST['feedback']."' 
  			              where id_feedback=".$_POST['id_feedback'];
	     mysql_query($sql);
 		/*print '<br>'.$sql.'<br>';*/
 	     print "Feedback has been edited!";
      }
}

/* delete comentariu */

if(isset($_POST['delete']))
{
       $sql="delete from feedbacks where id_feedback=".$_POST['id_feedback'];
       mysql_query($sql);
       print "Feedback has been deleted!";
}

/* setarea ultimului comentariu moderat din tabela admin */ 

if(isset($_POST['set_ok']))
{
	$sql="update admin set ultimul_comentariu_moderat=".$_POST['last_id'];  
	mysql_query($sql);
	print "The value has been set";
}


?> 

</body>
</html>
