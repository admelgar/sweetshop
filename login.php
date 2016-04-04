<title>Sweets Shop</title>

<link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php
error_reporting(E_ERROR | E_PARSE);
?>
<br>
<?
session_start();

/* verify if all the lines are fill */

if($_POST['name'] == "" || $_POST['password'] == "")
{
	print '<h1>Fill in all the lines!</h1> <br>
	<a href="index.php">Back</a>';
	exit;
}

/* Connecting to the data base:*/ 

/*include("conectare.php");*/

mysql_connect("localhost", "root", "");
mysql_select_db("store"); 


 $passwordEncriptata=md5($_POST['password']);

/*
 INSERT INTO admin VALUES ("administrator", md5("password"));
*/

/* si scriem interogarea de verificare: */

$sql = "select * from admin where admin_name='".$_POST['name']."' and 
				admin_password='".$passwordEncriptata."'";

/*print "<br>".$sql."<br>";*/

$resursa = mysql_query($sql);

/*print_r($resursa."<br>");*/


if(mysql_num_rows($resursa) != 1)
{
	print '<h1>Wrong name or password</h1><br>
		<a href="index.php">Back</a>';
	exit;
	/*if you want to see what this variables hold $sql, $resursa, ect… :

	print_r(mysql_num_rows($resursa));
	*/
}


 $_SESSION['name_admin'] = $_POST['name']; 
 $_SESSION['password_encriptata'] = $passwordEncriptata;
 $_SESSION['key_admin'] = session_id(); 

/*header("location: admin.php");*/
include("admin.php");
?>
