<?
  include ("autorizare.php");
  include ("admin_top.php");


if(isset($_POST['edit_category']))
{
  /* Verify if the new name of the category exists. */ 
  if($_POST['category']=="")
  {
 	print "Choose a category! ";
  }else{
        $sql = "update categories set category='".$_POST['category']."' 
			   where id_category=".$_POST['id_category'];
	mysql_query($sql);
 	/*print '<br>'.$sql.'<br>';*/
 	print "The name of the category has been changed!";
  }

  /* if(conditie) {codul de executat; exit}; ? redundant*/
}


if(isset($_POST['delete_category']))
{
       $sql3="delete from categories where id_category=".$_POST['id_category'];
       mysql_query($sql3);
       print "The category has been deleted!";
}


if(isset($_POST['edit_brand']))
{

	if($_POST['brand']=="")
	{
		print "Write brand";
	}else{
		$sql4="update brands set brand='".$_POST['brand']."'  
                                where id_brand=".$_POST['id_brand'];
		mysql_query($sql4);
		print "The brand has been updated!";
	}
}

/* deletere brand */ 

if(isset($_POST['delete_brand']))
{
	$sql = "delete from brands where id_brand=".$_POST['id_brand'];
	mysql_query($sql);
	print "The brand had been deleted!";
}

/* editt informatii item */ 

if(isset($_POST['edit_item']))
{
	/* Verificam daca toate datele au fost introduse corect. N-am vrea sa 
	introducem date eronate in tabela doar pentru ca a sarit pisica pe 
	tastatura si a apasat ENTER in timp ce introduceam datele. Daca, credeti  
	nu vi se poate intampla ... ei bine, din proprie experienta va spun ca se 
	ca poate. Vom folosi o structura  if  ... else if ... else: */

	if($_POST['item'] == "")
	{
   		print "Write item !";
	}
        else if($_POST['description'] == "")
	     {
    		print "Write description!";
	     }
             else if($_POST['price'] == "")
		  {
    			print "Write price!";
		  }
                  else if(!is_numeric($_POST['price']))
		       {
			     print "The price has to be numeric! 
          	       			Write <b>1000</b>, not <b>1000 lei</b>!";
		       }else{
			     $sql="update items set 
					id_category=".$_POST['id_category'].",
				          id_brand=".$_POST['id_brand'].",
					    item='".$_POST['item']."',
				        description='".$_POST['description']."',
					      price=".$_POST['price']."
				    where id_item=".$_POST['id_item']; 
			     /*print '<br>'.$sql.'<br>';*/
			     mysql_query($sql); 
			     print "The informations has been updated!";
		      }
}

/* deletere item */

if(isset($_POST['delete_item']))
{
	$sqlItem="delete from items where id_item=".$_POST['id_item']; 
	mysql_query($sqlItem); 
        $sqlComentarii="delete from comentarii where id_item=".$_POST['id_item']; 
	mysql_query($sqlComentarii);
        print "The item has been deleted!";
}

?> 

</body>
</html>
