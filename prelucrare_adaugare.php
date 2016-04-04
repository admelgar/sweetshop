<?
  session_start();
  include("autorizare.php");
  include("admin_top.php");

if(isset($_POST['add_category']))
{
  /*
  inainte de a introduce noul name de domeniu verificam doua lucruri:
	-campul sa nu fie gol,
	-sa nu existe deja in tabela
  */
  if($_POST['category_name'] == "")
  {
	print 'Please enter a category! <br>
        <a href="adaugare.php">Back</a>';
        exit;
  }
  /*verificam daca nu exista deja in tabela*/

  $sql="select * from categories where category='".$_POST['category_name']."'";
  $sursa=mysql_query($sql);

  /*interogarea returneaza 0 randuri daca domeniul nu exista in tabela. 
    Daca nu returneaza 0 inseamna ca domeniul exista deja in tabela, 
    nu-l vom mai introduce inca o data, vom atentiona utilizatorul de eroare 
    si vom intrerupe executia scriptului 
  */
  if(mysql_num_rows($sursa) != 0)
  {
	print 'Category <b>'.$_POST['category_name'].'</b> already exists in database!<br>
               <a href="adaugare.php">Back</a>';
        exit;
  }

  /*adaugam noul name de domeniu in tabela*/

  $sql="insert into categories(category) values('".$_POST['category_name']."')";
  mysql_query($sql);

  /*afisam utilizatorului un mesaj de confirmare*/   
	print 'Category <b>'.$_POST['category_name'].'</b> has been added in database!<br>
               <a href="adaugare.php">Back</a>';
        exit;
}

  /*acelasi script cu mici diferente il vom folosi pentru a adauga un autor nou*/

  if(isset($_POST['add_brand']))
  {
	    /*verificam campul sa nu fie gol*/
    if($_POST['brand_name'] == "")
    {
	print 'Please enter a brand! <br>
               <a href="adaugare.php">Back</a>';
        exit;
    }
  /*verificam daca nu exista deja in tabela*/

  $sql="select * from brands where brand='".$_POST['brand_name']."'";
  $sursa=mysql_query($sql);
  if(mysql_num_rows($sursa) != 0)
  {
	print 'Brand <b>'.$_POST['brand_name'].'</b> already exists in database!<br>
               <a href="adaugare.php">Back</a>';
        exit;
  }

  /*am verificat sa nu fie erori si putem sa adaugam in tabela*/

  $sql="insert into brands(brand) values('".$_POST['brand_name']."')";
  mysql_query($sql);

  /*afisam utilizatorului un mesaj de confirmare*/   

	print 'Brand <b>'.$_POST['brand_name'].'</b> has been added in database!<br>
               <a href="adaugare.php">Back</a>';
        exit;
}

/*
  scriptul pentru adaugarea cartii va fi un pic mai complicat deoarece trebuie sa facem 
  mai multe verificari la nivel de variabile  
*/

if(isset($_POST['add_item']))
{
   	/*verificam daca titlul, descrierea sau pretul nu sunt goale*/

       if($_POST['item'] == "" || $_POST['description'] == "" || $_POST['price'] == "")
       {
	  print 'Please complete all the fields for: item, description, and price! <br><a href="adaugare.php">Back</a>';
          exit;
       }

       /*verificam daca valoarea introdusa in campul pret este de tip numeric*/

       if(!is_numeric($_POST['price']))
       {
	  print 'Please enter a number for the price!<br>
	         <a href="adaugare.php">Back</a>';
          exit;
       }
	  /*verificam daca aceasta carte nu exista deja in tabela*/

       $sql="select * from items where id_brand='".$_POST['id_brand']."' and item='".$_POST['item']."'";
       $sursa=mysql_query($sql);
       if(mysql_num_rows($sursa) != 0)
       {
		print 'Already exists in database! <br>
		<a href="adaugare.php">Back</a>';
  		exit;
       }

	  /*am verificat sa nu existe erori, deci putem adauga carti in baza de date*/		
    $date = date('Y-m-d',strtotime($_POST['date']));
	  $sql="insert into items(id_brand,id_item,item,description,price,date,id_category) VALUES(
						     '".$_POST['id_brand']."',
						     '".$_POST['id_item']."',
						     '".$_POST['item']."',
						     '".$_POST['description']."',
						     '".$_POST['price']."',
						     '$date',
						     '".$_POST['id_category']."')";
	  mysql_query($sql);

	  /*afisam utilizatorului un mesaj de confirmare*/

	  print 'Item successfully added in database!<br>
	  	 <a href="adaugare.php">Back</a>';
	  exit;
	}
?>
</body>
</html>