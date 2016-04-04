<?
session_start();

include("conectare.php");

function autorizat()
{
  $sql="select * from admin where admin_name='".$_SESSION['name_admin']."' and 
                                admin_password='".$_SESSION['password_encriptata']."'";
  $sursa=mysql_query($sql);
  if($_SESSION['key_admin'] != session_id() || mysql_num_rows($sursa) != 1)
  {
	return false;
  }else{
  	return true;
  }
}
?>