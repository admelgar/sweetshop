<?
include("autorizare.php"); 
 include("admin_top.php");

print '<h2>Orders</h2>'; 

if(isset($_POST['checked']))
{
	$sql = "update transactions set checked=1 
			   where id_trans=".$_POST['id_trans'];
	mysql_query($sql);
 	print "The order has been checked";
}

if(isset($_POST['cancel_order']))
{
	$sqlTransactions = "delete from transactions where id_trans=".$_POST['id_trans']; 
mysql_query($sqlTransactions);

$sqlItems = "delete from sales where id_trans=".$_POST['id_trans'];
mysql_query($sqlItems);

 print "The order has been cancelled";
}
?> 
</body> 
</html>