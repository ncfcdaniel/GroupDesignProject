
 
 <?php
require ("config.php");



$OrderID=$_GET['OrderID'];
$ProductCode=$_GET['ProductCode'];




$sqlQuery2 = $pdo->prepare('UPDATE `suppliedorder` INNER JOIN `order` ON suppliedorder.OrderID = `order`.OrderID 
 INNER JOIN supplier ON suppliedorder.SupplierID = supplier.SupplierID 
INNER JOIN suppliedproducts ON suppliedorder.ProductCode = suppliedproducts.ProductCode SET Delivered = 1 WHERE `order`.OrderID = :OrderID AND suppliedorder.ProductCode =  :ProductCode');

$sqlQuery2-> bindParam(':OrderID', $OrderID);
$sqlQuery2-> bindParam(':ProductCode', $ProductCode);
$sqlQuery2->execute();


echo "Order Delivered! You will now be redirected!";
header("refresh:5;url=SystemReport.php");
?>


<br>

</div>


</body>
</html> 