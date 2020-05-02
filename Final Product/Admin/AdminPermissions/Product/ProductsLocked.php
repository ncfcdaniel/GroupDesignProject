
    <?php
  
  require 'config.php';
  session_start(); // should be at the top of your php

  if (isset($_POST['ProductCode'])) {
     $_SESSION['ProductCode'] = $_POST['ProductCode'];
  }
   $ProductCode = isset($_SESSION['ProductCode']) ? $_SESSION['ProductCode'] : "";




  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  } else {
    $pageno = 1;
  }
  $numberofrecords = 4;
  $offset = ($pageno-1) * $numberofrecords;
  if($ProductCode!=""){
  $stmt = $pdo->prepare("SELECT * FROM product WHERE ProductCode =?"); 
  $stmt->execute([$ProductCode]);
  $totalnumberofrows = $stmt ->rowCount();
  $total_pages = ceil($totalnumberofrows / $numberofrecords);
  $stmt = $pdo->prepare("SELECT * FROM product WHERE ProductCode ='".$ProductCode."'LIMIT $offset, $numberofrecords "); 
$stmt->execute();}
?>


<div class="container">

<div class="outputresults">

<br>


<?php


echo "<TABLE BORDER=1 width=600>";

while($row = $stmt->fetch())
{

      echo "<TD align=center>".$row['ProductCode']."</TD>";
      echo "<TD align=center><a href='EditProduct.php?ProductCode=".$row['ProductCode']."'>Edit</a>";
      echo "<TD align=center><a href='DeletProduct.php?ProductCode=".$row['ProductCode']."'>Delete Car</a>";

}
echo "</TABLE>";

?>


<br>

  
  </div>
  </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/main.js"></script>
</body>
</html>