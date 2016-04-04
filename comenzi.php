<?
include("autorizare.php");
 include("admin_top.php");
?>

<h1>Orders</h1>

 
<?
/* 
 include("conectare.php");
Afiºãm lista comenzilor neonorate (WHERE comanda_onorata=0) din
   tabelul tranzacþii: 
*/

$sqlTransactions = "select id_trans, DATE_FORMAT(date_trans,'%d-%m-%y')
     as date_trans, customer, address from transactions where checked=0";

/*
DATE_FORMAT(date_trans,'%d-%m-%y')
     as 
DATE_FORMAT este o funcþief a MySQL cu care putem formata o datã stocatã într-un timestamp dupã cum dnrim
 (în cazul de faþã, zz-ll-aaaa). Funcþia nu modificã nimic in tabela ci doar afiºeazã un TIMESTAMP intr-un 
 format mai uºor digerabil (04-3-2003 în loc de 20030304) 
*/
 

$resursaTransactions = mysql_query($sqlTransactions);



while($rowTransaction = mysql_fetch_array($resursaTransactions))
{

?>

<form action="prelucrare_comenzi.php" method="POST">
  <br>
 Date of the order:

 <b><?=$rowTransaction['date_trans']?></b>
 <div style="width:500px; border:lpx solid #ffffff; background-color #F9F1E7; padding:5px">

 <b><?=$rowTransaction['customer']?></b><br>
    <?=$rowTransaction['address']?>

 <TABLE border="1" cellpadding="4" cellspacing="0">
  <tr>
    <td align="center"><b>Item</b></td>
    <td align="center"><b>Number</b></td>
    <td align="center"><b>Price</b></td>
    <td align="center"><b>Total</b></td>
  </tr>

<?

  /* ºi, pentru fiecare tianzactie, afiºãm cartile 
   comandate (titlul ºi autorul), numarul si valoarea lor: 
  */

  $sqlItems = "select item,brand,price,number from sales,items,brands 
			where items.id_item=sales.id_item and 
			items.id_brand=brands.id_brand and 
			id_trans=".$rowTransaction['id_trans'];
 
  $resursaItems=mysql_query($sqlItems); 

  while($rowItem=mysql_fetch_array($resursaItems))
  { 
	print '<tr><td>'.$rowItem['brand'].' '.$rowItem['item'].'</td>'
      .'<td align="right">'.$rowItem['number'].'</td> 
		   <td align="right">'.$rowItem['price'].'</td>';
/* 62 Calculam totalul pentru aceastã carte (preþ * nr_buc)*/

$total=$rowItem['price']*$rowItem['number'];

/* Afisam acest total ºi apoi il adunam la totalul general pentru aceastã comanda. */

print '<td align="right">'.$total.'</td></tr>';

$totalGeneral = $totalGeneral + $total;

}


?>
</table>
<br>
 

 <INPUT type="hidden" name="id_trans" value="<?=$rowTransaction['id_trans']?>"> 

 <INPUT type="submit" id="submit" name="checked" value="Checked"> 
<INPUT type="submit" id="submit" name="cancel_order" value="Cancel order"> 
 
</div> 
</form> 

<? 

}

?>
<h1>Total of the orders:<?=$totalGeneral?> lei</h1>


</body>
</html>
